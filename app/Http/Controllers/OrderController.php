<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $orders = auth()->user()
            ->orders()
            ->with(['items.product', 'shippingAddress'])
            ->orderByDesc('created_at')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', [
            'order' => $order->load(['items.product', 'shippingAddress']),
        ]);
    }
}
