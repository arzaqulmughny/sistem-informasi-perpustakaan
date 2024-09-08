<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::factory()->create([
            'email' => 'superadmin01@demo.com',
            'role_id' => UserRole::SUPER_ADMIN,
            'created_by' => 0,
        ]);

        User::factory()->create([
            'email' => 'admin01@demo.com',
            'role_id' => UserRole::ADMIN,
            'created_by' => $superAdmin->id
        ]);

        User::factory()->create([
            'email' => 'staff01@demo.com',
            'role_id' => UserRole::STAFF,
            'created_by' => $superAdmin->id
        ]);
    }
}
