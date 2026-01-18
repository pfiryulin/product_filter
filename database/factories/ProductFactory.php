<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(23),
            'price' => fake()->randomFloat(2, 1000, 10000),
            'in_stock' => fake()->boolean(),
            'rating' => fake()->randomFloat(1, 0, 5),
        ];
    }
}
