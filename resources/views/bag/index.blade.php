@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Your Bag</h1>

        @if ($products->count())
            <div class="space-y-6 mb-10">
                @foreach ($products as $product)
                    <div class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm">
                        <div class="flex items-center gap-4">
                            <img src="{{ $product->primaryImage ? $product->primaryImage->url : 'https://via.placeholder.com/80x80?text=No+Image' }}"
                                 alt="{{ $product->name }}" class="w-20 h-20 rounded object-cover">

                            <div>
                                <h2 class="font-semibold text-gray-900">{{ $product->name }}</h2>
                                <p class="text-sm text-gray-500">Qty: {{ $bag[$product->id] }}</p>
                            </div>
                        </div>

                        <div class="text-right space-y-2">
                            <p class="text-gray-600 text-sm">Unit: ${{ number_format($product->price, 2) }}</p>
                            <p class="text-indigo-600 font-semibold">
                                Subtotal: ${{ number_format($product->price * $bag[$product->id], 2) }}
                            </p>

                            <form method="POST" action="{{ route('bag.remove') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="text-rose-600 text-sm hover:underline">
                                    Remover
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-center border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800">Total</h3>
                <p class="text-2xl font-bold text-indigo-600">${{ number_format($total, 2) }}</p>
            </div>

            <div class="mt-8 text-right">
            <a href="{{ route('checkout') }}"
            class="bg-indigo-600 text-white px-6 py-3 rounded-md font-medium hover:bg-indigo-700 transition">
            Proceed to Checkout
            </a>
            </div>
        @else
            <p class="text-gray-500">Your bag is empty. Go find something you love 💙</p>
        @endif
    </div>
</div>
@endsection
