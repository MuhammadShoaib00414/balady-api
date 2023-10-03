<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        Role::create(['name' => 'SuperAdmin']),
        Role::create(['name' => 'Admin']),
        Role::create(['name' => 'Trainer']),
        Role::create(['name' => 'Student'])
        ];
    }
}
