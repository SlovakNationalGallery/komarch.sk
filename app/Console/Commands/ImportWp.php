<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Redirect;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Tags\Tag;
use stdClass;

class ImportWp extends Command
{
    protected $signature = 'import:wp';

    protected $description = 'Import the WordPress database';

    protected $db;

    public function handle()
    {
        if (!$this->confirm('⚠️ This will truncate all current posts! Do you wish to continue?')) {
            return $this->info('OK. Bye.');
        }

        $this->truncateTables();

        $this->db = DB::connection('wordpress');

        $oldPosts = $this->db->table('wp_posts')
            ->where('post_status', 'publish')
            ->where('post_type', 'post')
            ->get();

        collect($oldPosts)
            ->each(function (stdClass $oldPost) {
                $post = Post::create([
                    'title' => $oldPost->post_title,
                    'text' => $this->sanitizePostContent($oldPost->post_content),
                    'wp_post_name' => $oldPost->post_name,
                    'published_at' => Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date),
                ]);

                $this->attachTags($oldPost, $post);

                $this->createRedirect($post);
            });

        $this->info("Done 🎉");
    }

    protected function truncateTables()
    {
        Schema::disableForeignKeyConstraints();

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

    protected function attachTags(stdClass $oldPost, Post $post)
    {
        $tags = $this->db->select(DB::raw("SELECT * FROM wp_terms
                 INNER JOIN wp_term_taxonomy
                 ON wp_term_taxonomy.term_id = wp_terms.term_id
                 INNER JOIN wp_term_relationships
                 ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                 WHERE taxonomy = 'category' AND object_id = {$oldPost->ID}"));

        collect($tags)
            ->map(function (stdClass $tag) {
                return $tag->name;
            })
            ->pipe(function (Collection $tags) use ($post) {
                return $post->attachTags($tags);
            });
    }
}