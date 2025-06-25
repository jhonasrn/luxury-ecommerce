@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-semibold mb-6">Product Catalog</h2>

    {{-- Linha 1 - Óculos escuros --}}
    <h3 class="text-lg font-bold text-gray-700 mb-2">Óculos Escuros</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @foreach ($sunglasses as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>

    {{-- Linha 2 - Relógios Premium --}}
    <h3 class="text-lg font-bold text-gray-700 mb-2">Relógios Premium</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @foreach ($watches as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>

    {{-- Linha 3 - Bolsas e Mochilas Elegantes --}}
    <h3 class="text-lg font-bold text-gray-700 mb-2">Bolsas & Mochilas</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @foreach ($bags as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>

    {{-- Linha 4 - Perfumes Sofisticados --}}
    <h3 class="text-lg font-bold text-gray-700 mb-2">Perfumes Sofisticados</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($fragrances as $product)
            @include('components.product-card', ['product' => $product])
        @endforeach
    </div>
</section>
@endsection
