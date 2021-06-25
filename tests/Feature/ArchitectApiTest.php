<?php

namespace Tests\Feature;

use App\Models\Architect;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ArchitectApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_works()
    {
        Architect::factory()->create();

        $response = $this->get('/api/architects');
        $response->assertStatus(200);
    }

    public function test_index_supports_search()
    {
        Architect::factory()->create(['last_name' => 'Bahna']);
        Architect::factory()->create(['last_name' => 'Králik']);

        $this->get(route('api.architects.index', ['q' => 'bah']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['last_name' => 'Bahna']
            ]]);
    }
}
