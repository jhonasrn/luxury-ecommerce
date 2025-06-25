<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [];

        // Óculos escuros
        for ($i = 1; $i <= 15; $i++) {
            $products[] = [
                'name' => "Óculos Aviator Luxo {$i}",
                'category' => 'Sunglasses',
                'description' => 'Óculos escuros com proteção UV400 e armação refinada.',
                'price' => rand(600, 1200),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Relógios premium
        for ($i = 1; $i <= 15; $i++) {
            $products[] = [
                'name' => "Relógio Elegance Nero {$i}",
                'category' => 'Watches',
                'description' => 'Relógio de pulso com acabamento premium e pulseira de couro legítimo.',
                'price' => rand(800, 2500),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bolsas ou mochilas elegantes
        for ($i = 1; $i <= 15; $i++) {
            $products[] = [
                'name' => "Bolsa Couro Vintax {$i}",
                'category' => 'Bags',
                'description' => 'Bolsa em couro legítimo com acabamento artesanal e design atemporal.',
                'price' => rand(700, 1600),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Perfumes sofisticados
        for ($i = 1; $i <= 15; $i++) {
            $products[] = [
                'name' => "Perfume Noblesse {$i}",
                'category' => 'Fragrances',
                'description' => 'Perfume importado com notas marcantes e fixação prolongada.',
                'price' => rand(480, 950),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Product::insert($products);
    }
}
