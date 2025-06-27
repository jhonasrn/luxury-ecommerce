<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BagController extends Controller
{
    public function index()
    {
        $bag = session()->get('bag', []);

        $products = Product::whereIn('id', array_keys($bag))->get();

        $total = $products->sum(function ($product) use ($bag) {
            return $product->price * $bag[$product->id];
        });

        return view('bag.index', compact('products', 'bag', 'total'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max((int) $request->input('quantity', 1), 1);

        $bag = session()->get('bag', []);
        $bag[$productId] = ($bag[$productId] ?? 0) + $quantity;

        session()->put('bag', $bag);

        return redirect()->route('bag.index')->with('success', 'Product added to bag!');
    }
    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        $bag = session()->get('bag', []);
        unset($bag[$productId]);

        session()->put('bag', $bag);

        return redirect()->route('bag.index')->with('success', 'Produto removido da bag.');
    }

}
