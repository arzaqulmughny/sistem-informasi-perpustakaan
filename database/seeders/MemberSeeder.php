<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::first();

        $data = [
            [
                'name' => 'Andi Wijaya',
                'address' => 'Jl. Merdeka No. 10, Surabaya, Jawa Timur',
                'phone_number' => '081234567890',
                'email' => 'andi.wijaya@email.com',
            ],
            [
                'name' => 'Siti Rahmawati',
                'address' => 'Jl. Pahlawan No. 45, Malang, Jawa Timur',
                'phone_number' => '082345678901',
                'email' => 'siti.rahmawati@email.com',
            ]
        ];

        foreach ($data as $member) {
            User::factory()->create(array_merge($member, [
                'created_by' => $superAdmin->id
            ]))->assignRole('member');
        }
    }
}
