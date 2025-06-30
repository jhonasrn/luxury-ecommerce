<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a list of orders, ordered by status priority and creation date.
     */
    public function index()
    {
        $orders = Order::with('user')
            ->orderByRaw("FIELD(status, 'pending', 'processing', 'shipped', 'delivered', 'cancelled')")
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the details of a specific order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update the status of an order to the next step in the flow.
     *
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function advanceStatus(Order $order)
    {
        $statusFlow = ['Confirmed', 'Processing', 'Shipped', 'Delivered'];

        $currentStatus = $order->status;
        $currentIndex = array_search($currentStatus, $statusFlow);

        if ($currentIndex !== false && isset($statusFlow[$currentIndex + 1])) {
            $order->status = $statusFlow[$currentIndex + 1];
            $order->save();

            return redirect()->back()->with('success', 'Order status updated successfully.');
        }

        return redirect()->back()->with('warning', 'This order cannot be advanced further.');
    }

}
