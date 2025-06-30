@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf

            {{-- Shipping Address --}}
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Delivery Address</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="full_name" placeholder="Full Name"
                        value="{{ old('full_name', $shippingAddress->full_name ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="phone" placeholder="Phone Number"
                        value="{{ old('phone', $shippingAddress->phone ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="address_line" placeholder="Address Line 1"
                        value="{{ old('address_line', $shippingAddress->address_line ?? '') }}"
                        class="border rounded px-4 py-2 text-sm col-span-2" required />

                    <input type="text" name="city" placeholder="City"
                        value="{{ old('city', $shippingAddress->city ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="state" placeholder="State"
                        value="{{ old('state', $shippingAddress->state ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="zip_code" placeholder="ZIP Code"
                        value="{{ old('zip_code', $shippingAddress->zip_code ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />
                </div>
            </div>

            {{-- Payment Section --}}
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Payment</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="card_name" placeholder="Name on Card"
                        value="{{ old('card_name', $payment->card_name ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="card_number" placeholder="Card Number"
                        value="{{ old('card_number', $payment->card_number ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="expiration_date" placeholder="MM/YY"
                        value="{{ old('expiration_date', $payment->expiration_date ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />

                    <input type="text" name="cvv" placeholder="CVV"
                        value="{{ old('cvv', $payment->cvv ?? '') }}"
                        class="border rounded px-4 py-2 text-sm" required />
                </div>
                <p class="text-xs text-gray-500 mt-2">This is a simulation — no actual charge will be made.</p>
            </div>

            {{-- Order Summary --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">Order Summary</h2>

                <div class="space-y-4 mb-6">
                    @foreach ($products as $product)
                        @php
                            $isPersisted = isset($product->product);
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
