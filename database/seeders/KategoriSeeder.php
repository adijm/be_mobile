<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id'   => 1, // Pastikan ID sesuai dengan yang digunakan di BookSeeder
            'name' => 'Programming',
        ]);
    }
}
