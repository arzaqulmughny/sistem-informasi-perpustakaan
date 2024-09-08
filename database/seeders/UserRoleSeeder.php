<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'id' => UserRole::SUPER_ADMIN,
            'name' => 'Super Admin',
        ]);

        UserRole::create([
            'id' => UserRole::ADMIN,
            'name' => 'Admin',
        ]);

        UserRole::create([
            'id' => UserRole::STAFF,
            'name' => 'Staff',
        ]);
    }
}
