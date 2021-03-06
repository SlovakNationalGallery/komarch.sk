<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\RefreshSearchIndex;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase, RefreshSearchIndex;

    public function testIndex()
    {
        $response = $this->get(route('api.posts.index'));
        $response->assertStatus(200);
    }

    public function testFilters()
    {
        $response = $this->get(route('api.posts-filters.index'));
        $response->assertStatus(200);
    }

    public function testSearch()
    {
        Post::factory()->published()->create(['title' => 'Dovoľujeme si Vás pozvať na vernisáž']);
        Post::factory()->published()->create(['title' => 'Deň lesa a krajiny v parlamente']);

        $this->get(route('api.posts.index', ['q' => 'verni']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['title' => 'Dovoľujeme si Vás pozvať na vernisáž']
            ]]);
    }

    public function testShow()
    {
        $post = Post::factory()->create();

        $this->get(route('api.posts.show', $post))
            ->assertJson([
                'id' => $post->id,
                'related' => []
            ]);
    }
}
