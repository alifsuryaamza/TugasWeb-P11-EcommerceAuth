<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        [$city, $province] = fake()->randomElement([
    ['Medan', 'Sumatera Utara'],
    ['Bandung', 'Jawa Barat'],
    ['Surabaya', 'Jawa Timur'],
    ['Yogyakarta', 'DI Yogyakarta'],
]);

return [
    'user_id' => \App\Models\User::factory(),
    'label' => fake()->randomElement(['Rumah', 'Kantor']),
    'recipient' => fake()->name(),
    'phone' => '08' . fake()->numerify('##########'),
    'street' => 'Jl. ' . fake()->streetName() . ' No. ' . fake()->numberBetween(1, 99),
    'city' => $city,
    'province' => $province,
    'postal_code' => fake()->numerify('#####'),
];
    }
}
