<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gender;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'gender', 'images'])
            ->latest()
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $genders = Gender::orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'genders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'price'               => ['required', 'numeric', 'min:0'],
            'stock_quantity'      => ['required', 'integer', 'min:0'],
            'low_stock_threshold' => ['required', 'integer', 'min:0'],
            'status'              => ['required', 'in:active,inactive,discontinued'],
            'category_id'         => ['required', 'exists:categories,id'],
            'gender_id'           => ['required', 'exists:genders,id'],
            'image_url'           => ['nullable', 'string', 'max:2048'],
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        // Ensure slug is unique
        $slug = $validated['slug'];
        $count = 1;
        while (Product::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $slug . '-' . $count++;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('status', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = Category::orderBy('name')->get();
        $genders = Gender::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'genders'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'price'               => ['required', 'numeric', 'min:0'],
            'stock_quantity'      => ['required', 'integer', 'min:0'],
            'low_stock_threshold' => ['required', 'integer', 'min:0'],
            'status'              => ['required', 'in:active,inactive,discontinued'],
            'category_id'         => ['required', 'exists:categories,id'],
            'gender_id'           => ['required', 'exists:genders,id'],
            'image_url'           => ['nullable', 'string', 'max:2048'],
        ]);

        // Regenerate slug if name changed
        if ($product->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $count = 1;
            $newSlug = $slug;
            while (Product::where('slug', $newSlug)->where('id', '!=', $product->id)->exists()) {
                $newSlug = $slug . '-' . $count++;
            }
            $validated['slug'] = $newSlug;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->orderItems()->exists()) {
            return redirect()->route('admin.products.index')
                ->with('error', "Cannot delete \"{$product->name}\" — it is referenced by existing orders.");
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('status', 'Product deleted successfully.');
    }
}
