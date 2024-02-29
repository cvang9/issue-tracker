<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Shivang',
            'role' => 'user',
            'email' => 'user@mail.com',
        ]);

        User::factory()->create([
            'name' => 'dogesh',
            'role' => 'resolver',
            'email' => 'resolver@mail.com',
        ]);

        User::factory()->create([
            'name' => 'DB Admin',
            'role' => 'admin',
            'email' => 'admin@mail.com',
        ]);

        Department::factory()->create([
            'name' => 'Technical',
        ]);

        Department::factory()->create([
            'name' => 'Management',
        ]);

        Department::factory()->create([
            'name' => 'Security',
        ]);


        Resolver::factory()->create([
            'user_id' => 2,
            'department_id' => 2,
        ]);


        Ticket::factory(5)->create([
            'user_id' => 1,
            'department_id' => 2,
        ]);

        Ticket::factory(4)->create([
            'user_id' => 1,
            'department_id' => 1,
        ]);

    }
}
