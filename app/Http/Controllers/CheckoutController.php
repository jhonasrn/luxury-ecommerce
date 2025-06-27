<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\ShoppingBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $bagItems = ShoppingBag::with('product.primaryImage')
                ->where('user_id', auth()->id())
                ->get();

            if ($bagItems->isEmpty()) {
                return redirect()->route('bag.index')->with('error', 'Sua bag está vazia.');
            }

            $products = $bagItems; // cada item tem .product e .quantity
            $bag = $bagItems->pluck('quantity', 'product_id')->toArray();
            $total = $bagItems->sum(fn($item) => $item->product->price * $item->quantity);

            return view('checkout.index', compact('products', 'bag', 'total'));
        }

        // visitante
        $bag = session('bag', []);
        if (empty($bag)) {
            return redirect()->route('bag.index')->with('error', 'Sua bag está vazia.');
        }

        $products = Product::whereIn('id', array_keys($bag))->with('primaryImage')->get();
        $total = $products->sum(fn($p) => $p->price * $bag[$p->id]);

        return view('checkout.index', compact('products', 'bag', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address_line' => 'required|string|max:255',
            'city'         => 'required|string|max:100',
            'state'        => 'required|string|max:100',
            'zip_code'     => 'required|string|max:20',
        ]);

        if (auth()->check()) {
            $bagItems = ShoppingBag::where('user_id', auth()->id())->get();

            if ($bagItems->isEmpty()) {
                return redirect()->route('bag.index')->with('error', 'Sua bag está vazia.');
            }

            $bag = $bagItems->pluck('quantity', 'product_id')->toArray();
        } else {
            $bag = session('bag', []);
            if (empty($bag)) {
                return redirect()->route('bag.index')->with('error', 'Sua bag está vazia.');
            }
        }

        $productIds = array_keys($bag);
        $products = Product::whereIn('id', $productIds)->get();

        DB::beginTransaction();

        try {
            $total = $products->sum(fn($p) => $p->price * $bag[$p->id]);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total'   => $total,
            ]);

            foreach ($products as $product) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $product->id,
                    'quantity'   => $bag[$product->id],
                    'unit_price' => $product->price,
                ]);
            }

            ShippingAddress::create([
                'order_id'     => $order->id,
                'full_name'    => $request->full_name,
                'phone'        => $request->phone,
                'address_line' => $request->address_line,
                'city'         => $request->city,
                'state'        => $request->state,
                'zip_code'     => $request->zip_code,
            ]);

            session()->forget('bag');
            if (auth()->check()) {
                ShoppingBag::where('user_id', auth()->id())->delete();
            }

            DB::commit();

            return redirect()->route('checkout.success');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao processar pedido: ' . $e->getMessage()]);
        }
    }
}
