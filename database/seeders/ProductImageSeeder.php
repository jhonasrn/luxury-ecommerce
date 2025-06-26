<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $categoryImages = [
            'Sunglasses' => 'https://images.unsplash.com/photo-1663344467443-96bee7dc5738',
            'Watches'    => 'https://images.unsplash.com/photo-1606744188285-d0a49e58f538',
            'Bags'       => 'https://images.unsplash.com/photo-1590739169125-a9438401596a',
            'Fragrances' => 'https://images.unsplash.com/photo-1615602400380-3795d0b23777',
        ];

        $products = Product::all();

        foreach ($products as $product) {
            $url = $categoryImages[$product->category] ?? $categoryImages['Sunglasses'];

            $product->images()->create([
                'url' => $url,
                'is_primary' => true,
            ]);
        }
    }
}
