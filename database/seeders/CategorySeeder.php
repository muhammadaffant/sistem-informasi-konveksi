<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'nama_kategori' => 'Kaos',
            'slug' => 'Kaos'

        ]);

        Category::create([
            'nama_kategori' => 'Jaket',
            'slug' => 'jaket'

        ]);

        Category::create([
            'nama_kategori' => 'Hodie',
            'slug' => 'Hodie'

        ]);
    }
}
