<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
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
       $name = fake()->words(3, true);

    return [
    'category_id' => \App\Models\Category::factory(),
    'name' => ucfirst($name),
    'slug' => \Illuminate\Support\Str::slug($name) . '-' . fake()->unique()->numberBetween(1, 99999),
    'description' => fake()->paragraph(3),
    'price' => fake()->numberBetween(20, 500) * 1000,
    'stock' => fake()->randomElement([0, 5, 12, 25, 40, 80]),
    'is_active' => true,
    ];
    }
}
