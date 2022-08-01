<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(20),
            'type' => fake()->numberBetween(1,25),
            'description' => fake()->text(maxNbChars: 200),
            'capacity' => fake()->numberBetween(0,100),
            'created_at' => now()
        ];
    }
}
