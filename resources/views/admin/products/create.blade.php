@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Create Product</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <select name="category" class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div>
            <label class="block text-sm font-medium mb-1">Unit Price (R$)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Stock -->
        <div>
            <label class="block text-sm font-medium mb-1">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <!-- Image upload -->
        <div>
            <label class="block text-sm font-medium mb-1">Product Image</label>
            <input type="file" name="image" class="border border-gray-300 rounded px-3 py-2 w-full">
            <p class="text-xs text-gray-500 mt-1">Add a primary image for the product.</p>
        </div>

        <!-- Action buttons -->
        <div class="pt-4 flex items-center justify-between gap-4">
            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200 transition">
                Cancel
            </a>

            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection
