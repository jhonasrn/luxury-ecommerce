<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by search text (id, name, description)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $search = $request->search;

                // If it's a number, also apply to the ID (product code)
                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }

                $q->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by exact category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Order by creation (most recent first)
        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        // Unique list of categories for the select filter
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('admin.products.index', compact('products', 'categories'));
    }

    // You can complete the other methods later, for example:
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }
}
