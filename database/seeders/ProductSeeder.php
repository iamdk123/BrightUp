<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Clear existing data
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'icon' => 'mobile-alt'],
            ['name' => 'Fashion', 'slug' => 'fashion', 'icon' => 'tshirt'],
            ['name' => 'Accessories', 'slug' => 'accessories', 'icon' => 'gem'],
            ['name' => 'Health', 'slug' => 'health', 'icon' => 'heartbeat'],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => 'running'],
            ['name' => 'Food', 'slug' => 'food', 'icon' => 'utensils']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            [
                'name' => 'Kaos Polos Hitam',
                'description' => 'Kaos polos warna hitam, bahan cotton combed 30s, nyaman dipakai sehari-hari.',
                'price' => 75000,
                'image' => 'kaos-hitam.jpg',
                'category_id' => 2  // Fashion
            ],
            [
                'name' => 'Celana Jeans Biru',
                'description' => 'Celana jeans biru dengan bahan denim premium, potongan slim fit yang nyaman dipakai harian maupun acara kasual.',
                'price' => 150000,
                'image' => 'celana-jeans.jpg',
                'category_id' => 2  // Fashion
            ],
            [
                'name' => 'Jaket Hoodie Abu',
                'description' => 'Jaket hoodie dengan bahan fleece tebal yang nyaman dan hangat. Cocok untuk aktivitas outdoor atau casual.',
                'price' => 200000,
                'image' => 'jaket-hoodie.jpg',
                'category_id' => 2  // Fashion
            ],
            [
                'name' => 'Kemeja Flanel Kotak',
                'description' => 'Kemeja flanel motif kotak dengan bahan premium yang nyaman, cocok untuk gaya kasual sehari-hari.',
                'price' => 120000,
                'image' => 'kemeja-flanel.jpg',
                'category_id' => 2  // Fashion
            ],
            [
                'name' => 'Topi Baseball Hitam',
                'description' => 'Topi baseball polos warna hitam, dengan bahan cotton yang nyaman dan adjustable size.',
                'price' => 60000,
                'image' => 'topi-baseball.jpg',
                'category_id' => 2  // Fashion
            ],
            [
                'name' => 'Sepatu Sneakers Putih',
                'description' => 'Sepatu sneakers casual warna putih, desain minimalis dengan bahan premium yang nyaman dipakai sepanjang hari.',
                'price' => 350000,
                'image' => 'sepatu-sneakers.jpg',
                'category_id' => 2 // Fashion
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
} 