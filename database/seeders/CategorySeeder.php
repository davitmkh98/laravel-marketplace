<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'description' => 'Electronic devices'
        ]);

        Category::create([
            'name' => 'Books',
            'slug' => 'books',
            'description' => 'Books and magazines'
        ]);

        Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'description' => 'Clothes and fashion'
        ]);

        Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'description' => 'Home and office furniture'
        ]);
    }
}