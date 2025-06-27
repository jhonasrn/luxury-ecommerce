@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Sua Bag</h1>

        @if ($products->isEmpty())
            <p class="text-gray-600">Sua bag está vazia.</p>
        @else
            <div class="bg-white rounded-lg shadow p-6 space-y-6">
                @foreach ($products as $product)
                    @php
                        $isPersisted = isset($product->product);
                        $prod = $isPersisted ? $product->product : $product;
                        $quantity = $isPersisted ? $product->quantity : ($bag[$product->id] ?? 1);
                    @endphp

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $prod->primaryImage->url ?? 'https://via.placeholder.com/80x80?text=No+Image' }}"
                                 alt="{{ $prod->name }}" class="w-20 h-20 object-cover rounded-md">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">{{ $prod->name }}</h2>
                                <p class="text-sm text-gray-500">Qtd: {{ $quantity }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-md text-gray-700 font-semibold">${{ number_format($prod->price * $quantity, 2) }}</p>

                            <form action="{{ route('bag.remove') }}" method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $prod->id }}">
                                <button type="submit" class="text-sm text-red-600 hover:underline">Remover</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-between border-t pt-4 text-lg font-bold text-gray-800">
                    <span>Total:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <div class="text-right">
                    <a href="{{ route('checkout.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition">
                        Finalizar Pedido
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
