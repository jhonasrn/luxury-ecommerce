@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">My Orders</h1>

    @if($orders->isEmpty())
        <p class="text-gray-600">You haven’t placed any orders yet.</p>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}"
                   class="block border border-gray-200 rounded-md p-4 hover:bg-gray-50 transition">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-800">Order #{{ $order->id }}</span>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ $order->items->count() }} item(s) —
                        Total: ${{ number_format($order->items->sum(fn($item) => $item->product->price * $item->quantity), 2) }}
                    </div>
                    <div class="text-sm text-indigo-600 mt-1">Status: {{ ucfirst($order->status) }}</div>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
