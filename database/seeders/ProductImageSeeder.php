<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        ProductImage::truncate();

        $categoryImages = [
            'Sunglasses' => 'https://images.unsplash.com/photo-1663344467443-96bee7dc5738?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'Watches'    => 'https://images.unsplash.com/photo-1606744188285-d0a49e58f538?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'Bags'       => 'https://images.unsplash.com/photo-1590739169125-a9438401596a?q=80&w=327&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
            'Fragrances' => 'https://images.unsplash.com/photo-1615602400380-3795d0b23777?q=80&w=435&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        ];

        $products = Product::all();

        foreach ($products as $product) {
            $url = $categoryImages[$product->category] ?? $categoryImages['Sunglasses'];

            ProductImage::create([
                'product_id' => $product->id,
                'url' => $url,
                'is_primary' => true,
            ]);
        }
    }
}
