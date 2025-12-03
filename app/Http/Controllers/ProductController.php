<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\AgeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Cache categories and age groups for 24 hours
        $categories = Cache::remember('categories', 86400, function () {
            return Category::all();
        });

        $ageGroups = Cache::remember('age_groups', 86400, function () {
            return AgeGroup::all();
        });

        // Build query with eager loading to prevent N+1
        $query = Product::with(['category', 'ageGroup', 'images'])
            ->where('is_active', true);

        // Apply category filter if provided
        if ($request->has('category') && $request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Apply age group filter if provided
        if ($request->has('age_group') && $request->filled('age_group')) {
            $query->where('age_group_id', $request->age_group);
        }

        // Apply search filter if provided
        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Apply sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Paginate results (12 per page)
        $products = $query->paginate(12);

        return view('products', compact('products', 'categories', 'ageGroups'));
    }

    /**
     * Show a single product detail page.
     */
    public function show(Product $product)
    {
        // Cache individual product for 24 hours
        $product = Cache::remember("product.{$product->id}", 86400, function () use ($product) {
            return $product->load(['category', 'ageGroup', 'images', 'reviews.user', 'sizes']);
        });

        return view('product.show', compact('product'));
    }
}