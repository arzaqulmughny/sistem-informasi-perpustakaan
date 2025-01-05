<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibarySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'min_loan_days',
                'default_value' => 1,
                'name' => 'Minimal Pinjam (Hari)',
                'type' => Setting::LIBRARY_TYPE
            ],
            [
                'key' => 'max_loan_days',
                'default_value' => 7,
                'name' => 'Maksimal Pinjam (Hari)',
                'type' => Setting::LIBRARY_TYPE
            ],
            [
                'key' => 'loans_limit',
                'default_value' => 1,
                'name' => 'Maksimal Pinjam Per Anggota',
                'description' => 'Maksimal buku yang dapat dipinjam per anggota. 0 untuk tak terbatas.',
                'type' => Setting::LIBRARY_TYPE
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
