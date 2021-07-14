<?php

namespace Tests\Feature;

use App\Models\Contest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\RefreshSearchIndex;
use Tests\TestCase;

class ContestApiTest extends TestCase
{

    use RefreshDatabase, RefreshSearchIndex;

    public function testIndex()
    {
        $response = $this->get(route('api.contests.index'));
        $response->assertStatus(200);
    }

    public function testSearchByName()
    {
        Contest::factory()->create(['title' => 'Vízia rozvoja obce Bernolákovo']);
        Contest::factory()->create(['title' => 'Vízia rozvoja obce Dunajská Streda']);

        $this->get(route('api.contests.index', ['q' => 'bernol']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['title' => 'Vízia rozvoja obce Bernolákovo']
            ]]);
    }

    public function testFilters()
    {
        $response = $this->get(route('api.contests-filters.index'));
        $response->assertStatus(200);
    }
}
