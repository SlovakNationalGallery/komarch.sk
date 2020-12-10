<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testDetailUrl()
    {
        $post = \App\Models\Post::factory()->create();
        $url = route('posts.show', [$post->slug]);
        $response = $this->get($url);
        $response->assertStatus(200);
    }

    public function testIndex()
    {
        $response = $this->get(route('posts.index'));
        $response->assertStatus(200);
    }
}
