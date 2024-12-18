<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data role
        $roles = [
            ['role' => 'Admin'],
            ['role' => 'Editor'],
            ['role' => 'User'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
