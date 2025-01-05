<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'name' => 'Developer',
            'email' => 'developer@demo.com',
            'role_id' => UserRole::SUPER_ADMIN,
            'created_by' => 0,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminsip@demo.com',
            'role_id' => UserRole::ADMIN,
            'created_by' => $superAdmin->id
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@demo.com',
            'role_id' => UserRole::STAFF,
            'created_by' => $superAdmin->id
        ]);
    }
}
