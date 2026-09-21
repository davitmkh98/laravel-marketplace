<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        $category = Category::where('slug', 'electronics')->first();

        Product::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'name' => 'iPhone 15',
            'slug' => 'iphone-15',
            'description' => 'Apple iPhone 15 smartphone',
            'price' => 999.99,
            'stock' => 10,
            'image' => null,
        ]);
    }
}