@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Order #{{ $order->id }}</h1>

    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Order Information</h2>
        <p><strong>Status:</strong> {{ $order->status }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
    </div>

    <div class="mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Shipping Address</h2>
        <p>{{ $order->shippingAddress->full_name ?? '-' }}</p>
        <p>{{ $order->shippingAddress->address_line_1 ?? '' }}</p>
        <p>{{ $order->shippingAddress->city ?? '' }} - {{ $order->shippingAddress->state ?? '' }}, {{ $order->shippingAddress->zip_code ?? '' }}</p>
        <p>{{ $order->shippingAddress->country ?? '' }}</p>
    </div>

    <div class="mb-12">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Items</h2>
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Unit Price</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($order->items as $item)
                    <tr>
                        <td class="px-4 py-2">{{ $item->product->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->quantity }}</td>
                        <td class="px-4 py-2">${{ number_format($item->unit_price, 2) }}</td>
                        <td class="px-4 py-2">
                            ${{ number_format($item->unit_price * $item->quantity, 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('client.dashboard') }}"
       class="inline-block px-4 py-2 bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-700 rounded">
        ← Back to Orders
    </a>
</div>
@endsection
