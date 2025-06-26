<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [];

        $categories = [
            'Sunglasses' => 'Óculos Aviator Luxo',
            'Watches' => 'Relógio Elegance Nero',
            'Bags' => 'Bolsa Couro Vintax',
            'Fragrances' => 'Perfume Noblesse',
        ];

        foreach ($categories as $category => $baseName) {
            for ($i = 1; $i <= 60; $i++) {
                $products[] = [
                    'name' => "{$baseName} {$i}",
                    'category' => $category,
                    'description' => fake()->sentence(10),
                    'price' => rand(500, 2500),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Product::insert($products);
    }
}
// This seeder creates 240 products across 4 categories, each with a unique name and random price.