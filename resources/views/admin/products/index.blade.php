@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="px-6 py-8">
    <div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-900">Products</h1>

    <a href="{{ route('admin.products.create') }}"
    class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
        + Add New Product
    </a>
</div>


<!-- Filtros -->
<form method="GET" class="flex flex-col md:flex-row items-end gap-4 mb-6">
    <div class="flex-1">
        <label class="block text-sm font-medium mb-1">Search</label>
        <input type="text" name="search" value="{{ request('search') }}"
            class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Code, name or description">
    </div>

    <div class="w-full md:w-64">
        <label class="block text-sm font-medium mb-1">Category</label>
        <select name="category" class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit"
        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
        Filter
    </button>
</form>

<!-- Tabela de produtos -->
<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full">
        <thead class="bg-gray-100 text-sm text-left">
            <tr>
                <th class="px-4 py-3 border-b">Product Code</th>
                <th class="px-4 py-3 border-b">Category</th>
                <th class="px-4 py-3 border-b">Name / Description</th>
                <th class="px-4 py-3 border-b">Unit Price</th>
                <th class="px-4 py-3 border-b">Stock</th>
                <th class="px-4 py-3 border-b"></th>
            </tr>
        </thead>
        <tbody class="text-sm divide-y divide-gray-200">
            @forelse ($products as $product)
                <tr>
                    <td class="px-4 py-3">#{{ $product->id }}</td>
                    <td class="px-4 py-3">{{ $product->category }}</td>
                    <td class="px-4 py-3">
                        <div class="font-medium">{{ $product->name }}</div>
                        <div class="text-gray-500 text-xs">{{ Str::limit($product->description, 50) }}</div>
                    </td>
                    <td class="px-4 py-3">R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.products.edit', $product) }}"
                            class="text-indigo-600 hover:underline text-sm">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginação -->
<div class="mt-6">
    {{ $products->withQueryString()->links() }}
</div>
</div>
@endsection
