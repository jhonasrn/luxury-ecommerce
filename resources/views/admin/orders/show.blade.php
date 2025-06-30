@extends('admin.layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Order #{{ $order->id }}</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('warning'))
        <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded mb-4">
            {{ session('warning') }}
        </div>
    @endif

    <!-- Order Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white shadow p-6 rounded-lg mb-8">
        <div>
            <h2 class="text-lg font-semibold mb-2">Order Details</h2>
            <p><strong>Status:</strong> <span class="capitalize">{{ $order->status }}</span></p>
            <p><strong>Created At:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Last Updated:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total, 2, ',', '.') }}</p>
        </div>
        <div>
            <h2 class="text-lg font-semibold mb-2">Customer Information</h2>
            <p><strong>Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Ordered Products -->
    <div class="bg-white shadow rounded-lg overflow-hidden mb-8">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 text-sm text-gray-600 uppercase text-left">
                <tr>
                    <th class="px-6 py-3">Product</th>
                    <th class="px-6 py-3">Unit Price</th>
                    <th class="px-6 py-3">Quantity</th>
                    <th class="px-6 py-3">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @foreach($order->items as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item->product->name ?? 'Deleted Product' }}</td>
                        <td class="px-6 py-4">${{ number_format($item->unit_price, 2, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 font-semibold">
                            ${{ number_format($item->unit_price * $item->quantity, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Advance Status Button -->
@if (!in_array($order->status, ['delivered', 'cancelled']))
    <form method="POST" action="{{ route('admin.orders.advanceStatus', $order) }}" class="mb-6">
        @csrf
        <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
            Advance to Next Status
        </button>
    </form>
@endif

    <!-- Back to Orders Button -->
    <div class="text-right">
        <a href="{{ route('admin.orders.index') }}"
           class="inline-block bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200 transition">
            ← Back to Orders
        </a>
    </div>
</div>
@endsection
