<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => static::$password ??= Hash::make('123456'),
            'role_id' => Admin::ROLE_ROOT_ADMIN,
            'remember_token' => Str::random(10),
        ];
    }
}
