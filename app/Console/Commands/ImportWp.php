<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Page;
use App\Models\Redirect;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\Tag;
use stdClass;
use Illuminate\Support\Str;

class ImportWp extends Command
{
    protected $signature = 'import:wp {--include-pages} {--download-cover-images} {--download-images}';

    protected $description = 'Import the WordPress database and images';

    protected $wordpressDb;
    protected $wordpressFs;

    const WP_UPLOADS = 'wp-content/uploads/';
    const EN_TERM_ID = 171;

    public function handle()
    {
        if (!$this->confirm('⚠️ This will truncate all current posts! Do you wish to continue?')) {
            return $this->info('OK. Bye.');
        }

        if ($this->option('download-images')) {
            $this->info('Downloading images to temporary directory');
            $this->info('Connecting to wordpress filesystem');

            $wordpressFs = Storage::disk('wordpress');
            $tempDir = sys_get_temp_dir();
            $downloadDir = $tempDir . '/komarch.sk/image-import-download';

            if (file_exists($downloadDir)) {
                if (!is_dir($downloadDir)) {
                    $this->warn('Cannot create download dir: file ' . $downloadDir . ' already exists');
                    return;
                }

                $this->info('Using existing download dir: ' . $downloadDir);
            } else {
                $this->info('Creating download dir: ' . $downloadDir);
                mkdir($downloadDir, 0777, true);
            }

            $files = $this->wordpressFs->allFiles(self::WP_UPLOADS);
            $extensions = [
                'jpg',
                'JPG',
                'jpeg',
                'JPEG',
                'png',
                'PNG',
            ];

            $copiedCount = 0;

            foreach ($files as $file) {
                $pathinfo = pathinfo($file);
                $fileDirname = $pathinfo['dirname'];
                $fileBasename = $pathinfo['basename'];
                $fileExtension = $pathinfo['extension'];

                assert($file == $fileDirname . '/' . $fileBasename);

                if (in_array($fileExtension, $extensions)) {
                    $this->info('Copying file: ' . $file);
                    try {
                        if (!$this->wordpressFs->exists($file)) {
                            // Some files have invalid characters in their
                            // filesnames and the Laravel FTP client doesn't
                            // like that. We just skip those files.

                            $this->info('Skipping missing file: ' . $file);
                            continue;
                        }

                        $contents = $this->wordpressFs->get($file);

                        $destDir = $downloadDir . '/' . $fileDirname;
                        $destFile = $downloadDir . '/' . $file;

                        if (file_exists($destDir)) {
                            if (!is_dir($destDir)) {
                                $this->warn('Cannot create directory: ' . $destDir . ' ... skipping files');
                                continue;
                            }
                        } else {
                            $this->info('Creating directory: ' . $destDir);
                            mkdir($destDir, 0777, true);
                        }

                        file_put_contents($destFile, $contents);

                        $copiedCount++;
                    } catch (Exception $e) {
                        $this->warn('Failed to copy file: ' . $file . ' ... skipping');
                    }
                }
            }
            $this->info('Copied ' . $copiedCount . ' images');
        }

        $this->info('Truncating local tables');
        $this->truncateTables();

        $this->info('Connecting to wordpress database');
        $this->wordpressDb = DB::connection('wordpress');

        $this->info('Querying posts in wordpress database');

        $types = ['post'];
        if ($this->option('include-pages')) {
            $types[] = 'page';
        }
        $oldPosts = $this->wordpressDb->table('wp_posts')
            ->where('post_status', 'publish')
            ->whereIn('post_type', $types)
            // exclude EN posts/pages
            ->whereNotIn('ID', function($query) {
                $query->select('object_id')->from('wp_term_relationships')->where('term_taxonomy_id', '=', self::EN_TERM_ID);
            })
            ->leftJoin('wp_postmeta', function ($join) {
                $join->on('wp_postmeta.post_id', '=', 'wp_posts.ID')
                    ->where('wp_postmeta.meta_key', '=', '_amfp_exclude_from_menu');
            })
            ->get();
        $bar = $this->output->createProgressBar(count($oldPosts));
        $bar->start();

        collect($oldPosts)
            ->each(function (stdClass $oldPost) use (&$bar) {
                $bar->advance();

                $now = Carbon::now();
                $publishedAt = Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date);

                if ($oldPost->post_type == 'post') {
                    $perex = $this->getPerex($oldPost->post_content);
                    $post = Post::create([
                        'title' => $oldPost->post_title,
                        'perex' => $perex,
                        'text' => $this->sanitizePostContent($oldPost->post_content),
                        'wp_post_name' => $oldPost->post_name,
                        'published_at' => $publishedAt,
                    ]);

                    if ($now->isAfter($publishedAt)) {
                        $post->searchable();
                    }

                    $this->attachTags($oldPost, $post);
                    if ($this->option('download-cover-images')) {
                        $this->addCoverImage($oldPost, $post);
                    }
                    $this->createRedirect($post);
                } else {
                    $page = Page::create([
                        'id' => $oldPost->ID,
                        'parent_id' => $oldPost->post_parent,
                        'title' => $oldPost->post_title,
                        'text' => $this->sanitizePostContent($oldPost->post_content),
                        'wp_post_name' => $oldPost->post_name,
                        'published_at' => Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date),
                        'menu_order' => ($oldPost->meta_value==0) ? $oldPost->menu_order : null,
                    ]);

                    // TODO: Make searchable

                    $this->attachTags($oldPost, $page);
                    if ($this->option('download-cover-images')) {
                        $this->addCoverImage($oldPost, $page);
                    }
                }
            });

        $bar->finish();

        if ($this->option('include-pages')) {
            $this->resolveTranslations();
        }

        $this->info("Done 🎉");
    }

    protected function truncateTables()
    {
        Schema::disableForeignKeyConstraints();

        Post::truncate();
        if ($this->option('include-pages')) {
            Page::truncate();
        }
        Redirect::truncate();
        // Tag::whereNull('type')->delete(); // better to keep them

        Schema::enableForeignKeyConstraints();
    }

    protected function createRedirect(Post $post)
    {
        Redirect::create([
            'old_url' => $post->wordpress_full_url,
            'new_url' => $post->url
        ]);
    }

    protected function sanitizePostContent(string $postContent): string
    {
        return nl2br($postContent);
    }

    protected function getPerex(string $postContent): ?string
    {
        $more_separator_tag = '<!--more-->';
        if (!Str::contains($postContent, $more_separator_tag)) {
            return null;
        }
        $slice = Str::before($postContent, $more_separator_tag);
        return strip_tags($slice);

    }

    protected function addCoverImage(stdClass $oldPost, \Illuminate\Database\Eloquent\Model $model)
    {
        $meta_post = $this->wordpressDb->table('wp_postmeta')->where('post_id', $oldPost->ID)->where('wp_postmeta.meta_key', '=', '_thumbnail_id')->first();
        if (empty($meta_post)) return null;
        $meta_thumbnail = $this->wordpressDb->table('wp_postmeta')->where('post_id', $meta_post->meta_value)->where('wp_postmeta.meta_key', '=', '_wp_attached_file')->first();
        if (empty($meta_thumbnail)) return null;
        $path = $meta_thumbnail->meta_value;
        $model->clearMediaCollection('cover');
        $model->addMediaFromDisk(self::WP_UPLOADS . $path, 'wordpress')
            ->preservingOriginal()
            ->toMediaCollection('cover');
    }

    protected function attachTags(stdClass $oldPost, \Illuminate\Database\Eloquent\Model $model)
    {
        $tags = $this->wordpressDb->select(DB::raw("SELECT * FROM wp_terms
                 INNER JOIN wp_term_taxonomy
                 ON wp_term_taxonomy.term_id = wp_terms.term_id
                 INNER JOIN wp_term_relationships
                 ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                 WHERE taxonomy = 'category' AND object_id = {$oldPost->ID}"));

        collect($tags)
            ->map(function (stdClass $tag) {
                return $tag->name;
            })
            ->pipe(function (Collection $tags) use ($model) {
                return $model->attachTags($tags);
            });
    }

    protected function resolveTranslations()
    {
        $en_ids = $this->wordpressDb->table('wp_term_relationships')
          ->where('term_taxonomy_id', '=', self::EN_TERM_ID)
          ->pluck('object_id');

        $this->info("\n" . 'Resolve translations for ' . count($en_ids) . ' pages');

        foreach ($en_ids as $en_id) {
            $taxonomy = $this->wordpressDb->table('wp_term_taxonomy')
              ->where('taxonomy', '=', 'post_translations')
              ->join('wp_term_relationships', function ($join) use ($en_id) {
                            $join->on('wp_term_relationships.term_taxonomy_id', '=', 'wp_term_taxonomy.term_taxonomy_id')
                                ->where('wp_term_relationships.object_id', '=', $en_id);
                        })->select('description')->first();

            if (empty($taxonomy->description)) continue;
            $description = unserialize($taxonomy->description);

            if (empty($description['sk'])) continue;
            $sk_id = $description['sk'];

            $oldPage = $this->wordpressDb->table('wp_posts')
                ->where('ID', $en_id)->first();
            $page = Page::find($sk_id);
            if ($page) {
                $page->setTranslation('title', 'en', $oldPage->post_title);
                $page->setTranslation('text', 'en', $this->sanitizePostContent($oldPage->post_content));
                $page->save();
            }
        }
    }
}
