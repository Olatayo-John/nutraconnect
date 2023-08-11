<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => '1',
            'news_category_id' => fake()->numberBetween($min = 1, $max = 5),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'image' => null,
        ];
    }
}
