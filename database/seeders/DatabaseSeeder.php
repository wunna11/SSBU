<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Course;
use App\Models\Exercise;
use App\Models\Quiz;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Video;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->count(10)->create();
        Teacher::factory()->count(10)->create();
        Course::factory()->count(10)->create();
        Exercise::factory()->count(10)->create();
        Quiz::factory()->count(20)->create();
        Video::factory()->count(20)->create();

        Category::factory()->count(10)->create();
        Audio::factory()->count(20)->create();

        $this->call(RoleSeeder::class);
    }
}
