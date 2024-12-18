<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data user
        $users = [
            [
                'role_id' => 1, // Admin
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'role_id' => 2, // Editor
                'name' => 'Editor User',
                'email' => 'editor@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'role_id' => 3, // User
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
