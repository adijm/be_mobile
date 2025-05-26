<?php

namespace Database\Seeders;

use App\Models\buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        buku::create([
            'title'            => 'Laravel for Beginners',
            'author'           => 'John Doe',
            'publisher'        => 'Tech Books',
            'isbn'             => '1234567890',
            'publication_year' => 2023,
            'stock'            => 10,
            'description'      => 'A beginner-friendly guide to Laravel.',
            'category_id'      => 1,
        ]);
    }
}
