<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminInventoryController extends Controller
{
    /**
     * Show the stock adjustment form for a product.
     */
    public function create($productId)
    {
        $product = Product::with('sizes')->findOrFail($productId);
        $logs = InventoryLog::where('product_id', $productId)
            ->with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.inventory.create', compact('product', 'logs'));
    }

    /**
     * Process a stock adjustment.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'action_type' => 'required|in:incoming,outgoing,adjustment',
            'quantity' => 'required|integer|min:1',
            'supplier_name' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:500',
        ]);

        $previousQty = $product->stock_quantity;

        switch ($validated['action_type']) {
            case 'incoming':
                $quantityChange = $validated['quantity'];
                $product->increment('stock_quantity', $quantityChange);
                break;
            case 'outgoing':
                $quantityChange = -$validated['quantity'];
                $product->decrement('stock_quantity', min($validated['quantity'], $product->stock_quantity));
                break;
            case 'adjustment':
                $quantityChange = $validated['quantity'] - $previousQty;
                $product->stock_quantity = $validated['quantity'];
                $product->save();
                break;
        }

        $product->refresh();

        // Log the inventory change
        InventoryLog::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'action_type' => $validated['action_type'],
            'quantity_change' => $quantityChange,
            'previous_quantity' => $previousQty,
            'new_quantity' => $product->stock_quantity,
            'supplier_name' => $validated['supplier_name'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('admin.products.index')->with('status', 'Stock updated successfully. New stock: ' . $product->stock_quantity);
    }
}
