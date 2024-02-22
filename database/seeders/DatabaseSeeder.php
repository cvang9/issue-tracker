<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()-> create([
            'name' => 'Shivang',
            'role' => 'user',
            'email' => 'user@mail.com'
        ]);

        User::factory()->create([
            'name' => 'dogesh',
            'role' => 'resolver',
            'email' => 'resolver@mail.com'
        ]);

        User::factory()->create([
            'name' => 'DB Admin',
            'role' => 'admin',
            'email' => 'admin@mail.com'
        ]);

    }
}
