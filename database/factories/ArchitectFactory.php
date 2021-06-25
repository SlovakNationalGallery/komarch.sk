<?php

namespace Database\Factories;

use App\Models\Architect;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'first_name' => $this->faker->firstName,
            'last_name' => Str::upper($this->faker->lastName),
            'title_after' => '',
        ];
    }
}
