<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\BookCopy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::where('role_id', User::SUPER_ADMIN)->first();

        for ($index = 0; $index < 30; $index++) {
            Book::factory()->create([
                'category_id' => rand(1, 5),
                'created_by' => $superAdmin->id,
            ]);
        }

        BookCategory::factory(5)->create([
            'created_by' => $superAdmin->id
        ]);

        BookCopy::factory(30)->create([
            'created_by' => $superAdmin->id,
        ]);
    }
}
