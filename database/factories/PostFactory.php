<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => Str::title($this->faker->words($nb = $this->faker->numberBetween(2,8), $asText = true)),
            'text' => $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
        ];
    }

    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => $this->faker->date(),
            ];
        });
    }

    /**
     * Post with rich content (tags, custom author ... )
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function rich()
    {
        return $this->state(function (array $attributes) {
            return [
                'author' =>  $this->faker->name(),
                'published_at' => $this->faker->dateTimeBetween('-5 years'),
            ];
        });
    }

}
