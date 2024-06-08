<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quiz>
 */
class QuizFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => fake()->sentence(),
            'option' => fake()->sentence(),
            'answer' => fake()->sentence(),
            'exercise_id' => Exercise::inRandomOrder()->first()->id ?? Exercise::factory(),
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory(),
        ];
    }
}
