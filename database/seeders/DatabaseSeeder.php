<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BookSeeder::class,
            MemberSeeder::class,
            UserRoleSeeder::class,
            LoanSeeder::class,
            SystemSettingSeeder::class,
            LibarySettingSeeder::class
        ]);
    }
}
