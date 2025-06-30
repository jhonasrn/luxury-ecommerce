<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a paginated list of products with optional search and category filters.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by search text (matches ID, name, or description)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $search = $request->search;

                // If numeric, apply to ID as well
                if (is_numeric($search)) {
                    $q->orWhere('id', $search);
                }

                $q->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by selected category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Order by most recently created products first
        $products = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get unique list of categories for filtering dropdown
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form to create a new product.
     */
    public function create()
    {
        // Fetch distinct categories to use in the form dropdown
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Show the form to edit an existing product.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Handle the update of a product after the edit form is submitted.
     */
    public function update(Request $request, Product $product)
    {
        // Validate incoming form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
        ]);

        // Update product with valid data
        $product->update($request->all());

        // Redirect back to the product list with a success message
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully.');
    }
    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload (optional)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = "/storage/{$imagePath}";
        }

        // Create product
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

}
