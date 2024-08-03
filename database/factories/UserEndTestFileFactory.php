<?php

namespace Database\Factories;

use App\Enums\FileStatus;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserEndTestFile>
 */
class UserEndTestFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'file_1' =>  fake()->imageUrl($width = 640, $height = 480),
            'file_2' => fake()->imageUrl($width = 640, $height = 480),
            'result' => fake()->randomElement(FileStatus::getValues()),
            'course_id' => Course::inRandomOrder()->first()->id ?? Course::factory(),
        ];
    }
}
