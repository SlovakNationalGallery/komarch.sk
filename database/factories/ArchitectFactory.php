<?php

namespace Database\Factories;

use App\Models\Architect;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArchitectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Architect::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'gender' => 'M',
            'title_before' => 'Ing.arch.',
            'first_name' => 'Ján Miloslav',
            'last_name' => 'BAHNA',
            'title_after' => '',
        ];
    }
}
