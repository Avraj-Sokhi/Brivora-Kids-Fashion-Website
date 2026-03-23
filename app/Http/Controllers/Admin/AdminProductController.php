<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gender;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'gender', 'images']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Stock status filter
        if ($request->filled('stock_status')) {
            switch ($request->stock_status) {
                case 'out':
                    $query->where('stock_quantity', '<=', 0);
                    break;
                case 'low':
                    $query->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
                          ->where('stock_quantity', '>', 0);
                    break;
                case 'in':
                    $query->whereColumn('stock_quantity', '>', 'low_stock_threshold');
                    break;
            }
        }

        $products = $query->orderBy('name')->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        $genders = Gender::all();

        return view('admin.products.create', compact('categories', 'genders'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'gender_id' => 'required|exists:genders,id',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,discontinued',
            'image_url' => 'nullable|string|max:500',
            'sizes' => 'nullable|array',
            'sizes.*.size' => 'required_with:sizes|string|max:20',
            'sizes.*.stock_quantity' => 'required_with:sizes|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'gender_id' => $validated['gender_id'],
            'stock_quantity' => $validated['stock_quantity'],
            'low_stock_threshold' => $validated['low_stock_threshold'],
            'status' => $validated['status'],
            'image_url' => $validated['image_url'],
        ]);

        // Create sizes if provided
        if (!empty($validated['sizes'])) {
            foreach ($validated['sizes'] as $sizeData) {
                if (!empty($sizeData['size'])) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $sizeData['size'],
                        'stock_quantity' => $sizeData['stock_quantity'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('status', 'Product created successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit($id)
    {
        $product = Product::with('sizes')->findOrFail($id);
        $categories = Category::all();
        $genders = Gender::all();

        return view('admin.products.edit', compact('product', 'categories', 'genders'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'category_id' => 'required|exists:categories,id',
            'gender_id' => 'required|exists:genders,id',
            'stock_quantity' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive,discontinued',
            'image_url' => 'nullable|string|max:500',
            'sizes' => 'nullable|array',
            'sizes.*.id' => 'nullable|integer',
            'sizes.*.size' => 'required_with:sizes|string|max:20',
            'sizes.*.stock_quantity' => 'required_with:sizes|integer|min:0',
        ]);

        $product->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'gender_id' => $validated['gender_id'],
            'stock_quantity' => $validated['stock_quantity'],
            'low_stock_threshold' => $validated['low_stock_threshold'],
            'status' => $validated['status'],
            'image_url' => $validated['image_url'],
        ]);

        // Sync sizes
        $existingIds = [];
        if (!empty($validated['sizes'])) {
            foreach ($validated['sizes'] as $sizeData) {
                if (!empty($sizeData['size'])) {
                    if (!empty($sizeData['id'])) {
                        // Update existing size
                        $size = ProductSize::find($sizeData['id']);
                        if ($size && $size->product_id === $product->id) {
                            $size->update([
                                'size' => $sizeData['size'],
                                'stock_quantity' => $sizeData['stock_quantity'] ?? 0,
                            ]);
                            $existingIds[] = $size->id;
                        }
                    } else {
                        // Create new size
                        $newSize = ProductSize::create([
                            'product_id' => $product->id,
                            'size' => $sizeData['size'],
                            'stock_quantity' => $sizeData['stock_quantity'] ?? 0,
                        ]);
                        $existingIds[] = $newSize->id;
                    }
                }
            }
        }

        // Remove sizes that were deleted from the form
        if (empty($existingIds)) {
            ProductSize::where('product_id', $product->id)->delete();
        } else {
            ProductSize::where('product_id', $product->id)
                ->whereNotIn('id', $existingIds)
                ->delete();
        }

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully.');
    }

    /**
     * Remove the specified product (set to discontinued).
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['status' => 'discontinued']);

        return redirect()->route('admin.products.index')->with('status', 'Product has been discontinued.');
    }
}
