<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\Conference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // Post::factory(10)->create();
        // Conference::factory(10)->create();
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password'=>Hash::make('password'),
        ]);
    }
}
