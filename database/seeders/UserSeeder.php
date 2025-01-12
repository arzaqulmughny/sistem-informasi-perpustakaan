<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        $roles = ['developer', 'admin', 'staff', 'member'];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'name' => $role
            ]);
        }

        // User
        $superAdmin = User::factory()->create([
            'name' => 'Developer',
            'email' => 'developer@demo.com',
            'created_by' => 0,
        ])->assignRole('developer');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'adminsip@demo.com',
            'created_by' => $superAdmin->id
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@demo.com',
            'created_by' => $superAdmin->id
        ])->assignRole('staff');

        User::factory()->create([
            'name' => 'Arza',
            'email' => 'member@demo.com',
            'created_by' => $superAdmin->id
        ])->assignRole('member');
    }
}
