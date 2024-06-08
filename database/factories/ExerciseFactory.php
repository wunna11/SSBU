<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'time' => fake()->randomDigit(),
            'rank' => fake()->randomDigit(),
            'pass_percentage' => fake()->randomDigit(),
            'unit_id' => Unit::inRandomOrder()->first()->id ?? Unit::factory(),
            'quantity' => fake()->randomDigit()
        ];
    }
}
