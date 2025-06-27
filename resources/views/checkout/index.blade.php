@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>
        

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf

            {{-- Formulário de endereço --}}
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Delivery Address</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="full_name" placeholder="Full Name" class="border rounded px-4 py-2 text-sm" required />
                    <input type="text" name="phone" placeholder="Phone Number" class="border rounded px-4 py-2 text-sm" required />
                    <input type="text" name="address_line" placeholder="Address Line 1" class="border rounded px-4 py-2 text-sm col-span-2" required />
                    <input type="text" name="city" placeholder="City" class="border rounded px-4 py-2 text-sm" required />
                    <input type="text" name="state" placeholder="State" class="border rounded px-4 py-2 text-sm" required />
                    <input type="text" name="zip_code" placeholder="ZIP Code" class="border rounded px-4 py-2 text-sm" required />
                </div>
            </div>

            {{-- Resumo da bag --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Order Summary</h2>

                <div class="space-y-4 mb-6">
                    @foreach ($products as $product)
                        @php
                            $isPersisted = isset($product->product); // para usuários logados
                            $prod = $isPersisted ? $product->product : $product;
                            $quantity = $isPersisted ? $product->quantity : ($bag[$product->id] ?? 1);
                        @endphp

                        <div class="flex justify-between text-sm">
                            <span>{{ $prod->name }} x{{ $quantity }}</span>
                            <span>${{ number_format($prod->price * $quantity, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between border-t pt-4 text-lg font-semibold text-gray-800">
                    <span>Total:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition">
                        Confirm Order
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
