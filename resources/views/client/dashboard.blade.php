@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">My Orders</h1>

    @if ($orders->isEmpty())
        <p class="text-gray-600 mb-8">You haven't placed any orders yet.</p>
    @else
        <div class="overflow-x-auto mb-12">
            <table class="w-full table-auto text-sm text-left border-collapse">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-2">Order #</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="px-4 py-2 font-medium text-indigo-600">#{{ $order->id }}</td>
                            <td class="px-4 py-2">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-2">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                    @switch($order->status)
                                        @case('Processing') bg-yellow-100 text-yellow-800 @break
                                        @case('Shipped') bg-blue-100 text-blue-800 @break
                                        @case('In Transit') bg-indigo-100 text-indigo-800 @break
                                        @case('Delivered') bg-green-100 text-green-800 @break
                                        @default bg-gray-100 text-gray-800
                                    @endswitch">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('orders.show', $order) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">
                                    View Details →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($suggestedProducts->isNotEmpty())
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Suggested Products</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($suggestedProducts as $product)
                <a href="{{ route('product.show', $product->slug) }}"
                   class="block bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <img src="{{ $product->primaryImage->url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
                         alt="{{ $product->name }}"
                         class="w-full h-40 object-cover rounded mb-4">
                    <h3 class="text-sm font-semibold text-gray-900">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600">${{ number_format($product->price, 2) }}</p>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
