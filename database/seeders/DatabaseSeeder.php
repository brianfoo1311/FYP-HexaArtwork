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
        User::create([
            'role_id' => User::ADMIN_ROLE_ID,
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'role_id' => User::ARTIST_ROLE_ID,
            'name' => 'artist',
            'email' => 'artist@test.com',
            'password' => bcrypt('user'),
        ]);

        User::create([
            'role_id' => User::USER_ROLE_ID,
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('user'),
        ]);
    }
}
