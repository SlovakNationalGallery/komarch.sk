<?php

namespace Tests\Feature;

use App\Models\Architect;
use App\Models\Number;
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

    public function test_search()
    {
        Architect::factory()->create(['last_name' => 'Bahna']);
        Architect::factory()->create(['last_name' => 'Králik']);

        $this->get(route('api.architects.index', ['q' => 'bah']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['last_name' => 'Bahna']
            ]]);
    }

    public function test_filtering_by_first_letter()
    {
        Architect::factory()->create(['last_name' => 'Bahna']);
        Architect::factory()->create(['last_name' => 'Králik']);

        $this->get(route('api.architects.index', ['startsWith' => 'b']))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['last_name' => 'Bahna']
            ]]);
    }

    public function test_filtering_by_authorizations()
    {
        $matching = Architect::factory()
            ->hasNumbers(1, ['architect_number' => '1000 AA'])
            ->create();

        Architect::factory()
            ->hasNumbers(1, ['architect_number' => '1001 KA'])
            ->create();

        $this->get(route('api.architects.index', ['authorizationsIn' => ['AA', 'DC']]))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['id' => $matching->id]
            ]]);
    }

    public function test_filtering_by_locations()
    {
        $matching = Architect::factory()
            ->hasAddresses(1, ['location_district' => 'Detva'])
            ->create();

        Architect::factory()
            ->hasAddresses(1, ['location_district' => 'Čadca'])
            ->create();

        $this->get(route('api.architects.index', ['locationDistrictsIn' => ['Detva']]))
            ->assertJsonCount(1, 'data')
            ->assertJson(['data' => [
                ['id' => $matching->id]
            ]]);
    }
}
