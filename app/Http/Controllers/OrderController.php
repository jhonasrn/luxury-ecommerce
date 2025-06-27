<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        // Garante que o usuário só acesse suas próprias orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', [
            'order' => $order->load(['items.product', 'shippingAddress']),
        ]);
    }
}
