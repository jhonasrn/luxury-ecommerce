@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 capitalize mb-6">{{ $label }} Collection</h1>

        @if ($products->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <img src="{{ $product->primaryImage ? $product->primaryImage->url : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                             alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>
                            <p class="text-sm text-gray-600 mt-1">{{ $product->description }}</p>
                            <div class="mt-2 text-indigo-600 font-bold text-right">
                                ${{ number_format($product->price, 2) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                {{ $products->links() }}
            </div>
        @else
            <p class="text-gray-500">No products available in this category yet.</p>
        @endif
    </div>
</div>
@endsection
