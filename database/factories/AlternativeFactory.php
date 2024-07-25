<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alternative>
 */
class AlternativeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'c1' => fake()->numberBetween(1, 10),
            'c2' => fake()->numberBetween(1, 10),
            'c3' => fake()->numberBetween(1, 10),
            'c4' => fake()->numberBetween(1, 10),
            'c5' => fake()->numberBetween(1, 10),
            'c6' => fake()->numberBetween(1, 10),
            'c7' => fake()->numberBetween(1, 10),
            'c8' => fake()->numberBetween(1, 10),
            'c9' => fake()->numberBetween(1, 10),
            'c10' => fake()->numberBetween(1, 10),
        ];
    }
}
