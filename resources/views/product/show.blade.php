@extends('layouts.app')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
            {{-- Product Image --}}
            <div>
                <img src="{{ $product->primaryImage ? $product->primaryImage->url : 'https://via.placeholder.com/600x600?text=No+Image' }}"
                     alt="{{ $product->name }}"
                     class="w-full max-w-md h-80 rounded-lg object-cover shadow-md mx-auto">
            </div>

            {{-- Product Info --}}
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                <p class="text-xl text-indigo-600 font-semibold mb-2">${{ number_format($product->price, 2) }}</p>

                <div class="text-gray-700 mb-6">
                    {{ $product->description }}
                </div>

                {{-- Quantity --}}
                <div class="flex items-center gap-4 mb-4">
                    <label for="quantity" class="text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" id="quantity" name="quantity_visible" value="1" min="1"
                           class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                {{-- Buttons --}}
                <div class="flex gap-4">
                    {{-- Add to Bag --}}
                    <form method="POST" action="{{ route('bag.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="add-quantity">
                        <button type="submit"
                                onclick="document.getElementById('add-quantity').value = document.getElementById('quantity').value"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                            Add to Bag
                        </button>
                    </form>

                    {{-- Buy Now --}}
                    <form method="POST" action="{{ route('bag.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="buy-quantity">
                        <input type="hidden" name="redirect_to_bag" value="1">
                        <button type="submit"
                                onclick="document.getElementById('buy-quantity').value = document.getElementById('quantity').value"
                                class="bg-gray-100 text-gray-900 px-6 py-2 rounded-md hover:bg-gray-200 transition">
                            Buy Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
