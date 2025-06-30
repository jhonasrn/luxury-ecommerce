<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $orderCountsByStatus = Order::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $userCountsByStatus = User::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $ordersToday = Order::whereDate('created_at', today())->count();
        $ordersThisWeek = Order::whereBetween('created_at', [now()->startOfWeek(), now()])->count();
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)->count();

        return view('admin.dashboard', compact(
            'orderCountsByStatus',
            'userCountsByStatus',
            'ordersToday',
            'ordersThisWeek',
            'ordersThisMonth'
        ));
    }
}
