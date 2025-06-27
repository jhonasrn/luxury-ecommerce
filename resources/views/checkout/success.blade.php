@extends('layouts.app')

@section('content')
<div class="bg-green-50 py-16">
    <div class="max-w-xl mx-auto text-center px-4">
        <svg class="mx-auto w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>

        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">Order Confirmed!</h1>
        <p class="text-gray-600 mb-6">Thank you for your purchase. We've received your order and will begin processing it shortly.</p>

        <a href="{{ route('orders.index') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-md font-medium hover:bg-indigo-700 transition">
            Track Orders
        </a>
    </div>
</div>
@endsection
