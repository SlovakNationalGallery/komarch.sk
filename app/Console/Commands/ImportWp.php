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
    protected $signature = 'import:wp {--download-images}';

    protected $description = 'Import the WordPress database and images';

    protected $wordpressDb;

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

            $files = $wordpressFs->allFiles('wp-content/uploads/');
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
                        if (!$wordpressFs->exists($file)) {
                            // Some files have invalid characters in their
                            // filesnames and the Laravel FTP client doesn't
                            // like that. We just skip those files.

                            $this->info('Skipping missing file: ' . $file);
                            continue;
                        }

                        $contents = $wordpressFs->get($file);

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
        $oldPosts = $this->wordpressDb->table('wp_posts')
            ->where('post_status', 'publish')
            ->whereIn('post_type', ['post', 'page'])
            ->leftJoin('wp_postmeta', function ($join) {
                $join->on('wp_postmeta.post_id', '=', 'wp_posts.ID')
                    ->where('wp_postmeta.meta_key', '=', '_amfp_exclude_from_menu');
            })
            ->get();

        collect($oldPosts)
            ->each(function (stdClass $oldPost) {
                $now = Carbon::now();
                $publishedAt = Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date);

                if ($oldPost->post_type == 'post') {
                    $perex = $this->getPerex($oldPost->post_content);
                    $post = Post::create([
                        'title' => $oldPost->post_title,
                        'perex' => $perex,
                        'text' => $this->sanitizePostContent($oldPost->post_content),
                        'wp_post_name' => $oldPost->post_name,
                        'published_at' => Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date),
                    ]);

                    if ($now->isAfter($publishedAt)) {
                        $post->searchable();
                    }

                    $this->attachTags($oldPost, $post);
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
                }
            });

        $this->info("Done 🎉");
    }

    protected function truncateTables()
    {
        Schema::disableForeignKeyConstraints();

        Page::truncate();
        Post::truncate();
        Tag::truncate();
        Redirect::truncate();

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
        // @TODO
        return $postContent;
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
}
