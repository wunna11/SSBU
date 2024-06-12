<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function root()
    {
        return $this->state([
            'id' => 1,
            'name' => 'root',
        ]);
    }

    public function rootAdmin()
    {
        return $this->state([
            'id' => 2,
            'name' => 'root-admin',
        ]);
    }

    public function manager()
    {
        return $this->state([
            'id' => 3,
            'name' => 'manager'
        ]);
    }
}
