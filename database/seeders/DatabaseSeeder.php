<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default user
        User::create([
            'name' => 'Default User',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
