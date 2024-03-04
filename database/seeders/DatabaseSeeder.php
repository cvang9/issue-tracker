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
            'email' => 'harshsaini5656@gmail.com',
            'img' => '1709361193_original.jpeg'
        ]);

        User::factory()->create([
            'name' => 'Rahul',
            'role' => 'resolver',
            'email' => 'resolver@mail.com',
            'img' => 'resolver_img.jpg'
        ]);

        User::factory()->create([
            'name' => 'Raman Singh',
            'role' => 'admin',
            'email' => 'admin@mail.com',
            'img' => 'user-06.png'
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


        Ticket::factory(1)->create([
            'user_id' => 1,
            'department_id' => 2,
        ]);

        Ticket::factory(2)->create([
            'user_id' => 1,
            'department_id' => 1,
        ]);

    }
}
