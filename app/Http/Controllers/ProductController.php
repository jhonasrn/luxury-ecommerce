<?php

namespace App\Http\Controllers;
    use App\Models\Product;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['primaryImage', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('product.show', compact('product'));
    }
}

