<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank' => fake()->company(),
            'name' => fake()->name(),
            'account' => fake()->phoneNumber(),
            'image' => fake()->imageUrl($width = 640, $height = 480),
            'rank' => fake()->randomDigit(),
            'status' => 0
        ];
    }
}
