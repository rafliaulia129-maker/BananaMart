<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@bananamart.test',
            ],
            [
                'name' => 'Admin BananaMart',
                'password' => 'password123',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            [
                'email' => 'pengguna@bananamart.test',
            ],
            [
                'name' => 'ChatGPT',
                'password' => 'password123',
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
    }
}