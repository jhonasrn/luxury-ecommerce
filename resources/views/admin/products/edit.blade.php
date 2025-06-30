@extends('admin.layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Product</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <input type="text" name="category" value="{{ old('category', $product->category) }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-medium mb-1">Unit Price (R$)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-sm font-medium mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                class="w-full border border-gray-300 rounded px-3 py-2" min="0">
        </div>

        <!-- Current image -->
        @if ($product->primaryImage)
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Current Image</label>
                <img src="{{ $product->primaryImage->url }}" alt="{{ $product->name }}"
                    class="w-48 h-auto rounded shadow border border-gray-200">
            </div>
        @endif
        <!-- Upload new image -->
        <div>
            <p class="text-sm text-gray-700 mb-1">Add more photos.</p>
            <input type="file" name="image" class="border border-gray-300 rounded px-3 py-2 w-full">
        </div>

        <!-- Submit -->
        <div class="pt-4 flex items-center justify-between gap-4">
            <a href="{{ route('admin.products.index') }}"
            class="bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200 transition">
                Cancel
            </a>

            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Save Changes
            </button>
        </div>

    </form>
</div>
@endsection
