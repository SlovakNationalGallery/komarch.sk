<?php

namespace Tests\Feature;

use App\Models\Architect;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArchitectApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $works = Work::factory()->count(2)->create();
        Architect::factory()
            ->hasAttached(
                $works,
                // Generate random ID for pivot table (as it is not auto-incrementing)
                fn () => ['id' => $this->faker->unique()->randomNumber()]
            )
            ->create([
                'id' => 1,
                'first_name' => 'Ján Miloslav',
                'last_name' => 'BAHNA',
            ]);

        $this->get('/api/architects')
            ->assertStatus(200)
            ->assertJson(['data' => [
                [
                    'id' => 1,
                    'first_name' => 'Ján Miloslav',
                    'last_name' => 'Bahna',
                    'works_count' => 2,
                ]
            ]]);
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
