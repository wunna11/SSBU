<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'outline' => fake()->realText($maxNbChars = 200, $indexSize = 2),
            'image' => fake()->imageUrl($width = 640, $height = 480),
            'teacher_id' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory(),
            'rank' => fake()->randomDigit(),
            'public' => 0,
            'endtest_status' => 0
        ];
    }
}
