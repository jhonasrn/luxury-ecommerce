<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ShoppingBag;

class BagController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $items = ShoppingBag::with('product')
                ->where('user_id', auth()->id())
                ->get();

            $total = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            return view('bag.index', [
                'products' => $items,
                'total' => $total,
                'bag' => [] // usado na view para compatibilidade
            ]);
        }

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

        if (auth()->check()) {
            $bagItem = ShoppingBag::firstOrNew([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);

            $bagItem->quantity += $quantity;
            $bagItem->save();
        } else {
            $bag = session()->get('bag', []);
            $bag[$productId] = ($bag[$productId] ?? 0) + $quantity;
            session()->put('bag', $bag);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product added to bag']);
        }

        if ($request->has('redirect_to_bag')) {
            return redirect()->route('bag.index')->with('success', 'Product added to your bag!');
        }

        return back()->with('success', 'Product added to your bag!');
    }

    public function remove(Request $request)
    {
        $productId = $request->input('product_id');

        if (auth()->check()) {
            ShoppingBag::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $bag = session()->get('bag', []);
            unset($bag[$productId]);
            session()->put('bag', $bag);
        }

        return redirect()->route('bag.index')->with('success', 'Product removed from your bag.');
    }
}
