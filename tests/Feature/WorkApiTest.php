<?php

namespace Tests\Feature;

use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\RefreshSearchIndex;
use Tests\TestCase;

class WorkApiTest extends TestCase
{

    use RefreshDatabase, RefreshSearchIndex;

    public function testIndex()
    {
        $response = $this->get(route('api.works.index'));
        $response->assertStatus(200);
    }

    public function testSearchByName()
    {
        Work::factory()->create(['name' => 'Televízna veža, Bratislava - Kamzík']);
        Work::factory()->create(['name' => 'Rezidencia Bárdošov, Bratislava']);

        $this->get(route('api.works.index', ['q' => 'kamz']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['name' => 'Televízna veža, Bratislava - Kamzík']
            ]]);
    }

    public function testFilters()
    {
        $response = $this->get(route('api.works-filters.index'));
        $response->assertStatus(200);
    }
}
