@extends('layouts.app')

@section('content')
    {{-- Catálogo de produtos --}}
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-semibold mb-6">Product Catalog</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            {{-- Exemplo de produto (substituir com @foreach futuramente) --}}
            <div class="bg-white shadow rounded p-4 text-center">
                <p class="text-gray-800 font-semibold">Sample Product</p>
                <p class="text-sm text-gray-500">Short description here</p>
            </div>
        </div>
    </section>
@endsection
