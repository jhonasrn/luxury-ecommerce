<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\ShoppingBag;
use App\Models\Payment;
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
                return redirect()->route('bag.index')->with('error', 'Your bag is empty.');
            }

            $products = $bagItems;
            $bag = $bagItems->pluck('quantity', 'product_id')->toArray();
            $total = $bagItems->sum(fn($item) => $item->product->price * $item->quantity);

            // Get saved address and payment info, if any
            $shippingAddress = ShippingAddress::where('user_id', auth()->id())->latest()->first();
            $payment = Payment::where('user_id', auth()->id())->latest()->first();

            return view('checkout.index', compact('products', 'bag', 'total', 'shippingAddress', 'payment'));
        }

        // Guest user
        $bag = session('bag', []);
        if (empty($bag)) {
            return redirect()->route('bag.index')->with('error', 'Your bag is empty.');
        }

        $products = Product::whereIn('id', array_keys($bag))->with('primaryImage')->get();
        $total = $products->sum(fn($p) => $p->price * $bag[$p->id]);

        return view('checkout.index', compact('products', 'bag', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Shipping fields
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'address_line'     => 'required|string|max:255',
            'city'             => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'zip_code'         => 'required|string|max:20',
            // Payment fields
            'card_name'        => 'required|string|max:255',
            'card_number'      => 'required|string|max:20',
            'expiration_date'  => 'required|string|max:10',
            'cvv'              => 'required|string|max:5',
        ]);

        $user = auth()->user();

        if ($user) {
            $bagItems = ShoppingBag::where('user_id', $user->id)->get();

            if ($bagItems->isEmpty()) {
                return redirect()->route('bag.index')->with('error', 'Your bag is empty.');
            }

            $bag = $bagItems->pluck('quantity', 'product_id')->toArray();
        } else {
            $bag = session('bag', []);
            if (empty($bag)) {
                return redirect()->route('bag.index')->with('error', 'Your bag is empty.');
            }
        }

        $productIds = array_keys($bag);
        $products = Product::whereIn('id', $productIds)->get();

        DB::beginTransaction();

        try {
            $total = $products->sum(fn($p) => $p->price * $bag[$p->id]);

            $order = Order::create([
                'user_id' => $user?->id,
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

            // Save shipping address
            $shipping = ShippingAddress::firstOrNew([
                'user_id' => $user?->id,
            ]);

            $shipping->fill([
                'full_name'    => $request->full_name,
                'phone'        => $request->phone,
                'address_line' => $request->address_line,
                'city'         => $request->city,
                'state'        => $request->state,
                'zip_code'     => $request->zip_code,
                'order_id'     => $order->id,
            ]);

            $shipping->user_id = $user?->id;
            $shipping->save();

            // Save payment info
            $payment = Payment::firstOrNew([
                'user_id' => $user?->id,
            ]);

            $payment->fill([
                'card_name'       => $request->card_name,
                'card_number'     => $request->card_number,
                'expiration_date' => $request->expiration_date,
                'cvv'             => $request->cvv,
            ]);

            $payment->user_id = $user?->id;
            $payment->save();

            // Clear cart
            session()->forget('bag');
            session()->forget('bagRestored');
            if ($user) {
                ShoppingBag::where('user_id', $user->id)->delete();
            }

            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Your order was placed successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error processing order: ' . $e->getMessage()]);
        }
    }
}
