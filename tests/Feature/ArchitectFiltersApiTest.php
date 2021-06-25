<?php

namespace Tests\Feature;

use App\Models\Architect;
use App\Models\Award;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArchitectFiltersApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        Architect::factory()
            ->hasNumbers(1, ['architect_number' => '1000 AA'])
            ->create(['last_name' => 'Bahna']);

        Architect::factory()
            ->hasNumbers(1, ['architect_number' => '1001 KA'])
            ->create(['last_name' => 'Králik']);

        $this->get(route('api.architects-filters.index'))
            ->assertJson([
                'startsWith' => [
                    'A' => false,
                    'B' => true,
                ],
                'authorizationsIn' => [
                    'AA' => 1,
                    'KA' => 1,
                    'HA' => 0,
                    'HKA' => 0,
                    'DC' => 0,
                ]
            ]);
    }
}
