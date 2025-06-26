<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class UpdateSunglassesImageSeeder extends Seeder
{
    public function run(): void
    {
        $novaImagem = 'https://images.unsplash.com/photo-1502767089025-6572583495f9?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0';

        Product::where('category', 'Sunglasses')->each(function ($product) use ($novaImagem) {
            $product->images()->where('is_primary', true)->delete();

            $product->images()->create([
                'url' => $novaImagem,
                'is_primary' => true,
            ]);
        });
    }
}
