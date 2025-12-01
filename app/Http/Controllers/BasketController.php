<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * Add a product to the basket.
     */
    public function add(Request $request, int $productId)
    {
        // Try to find product in database, but don't fail if it doesn't exist
        $product = Product::find($productId);

        // If product doesn't exist in DB, create a temporary product object
        // This allows the basket to work even without database products
        if (!$product) {
            $product = (object) [
                'id' => $productId,
                'name' => 'Product #' . $productId,
                'price' => 0.00,
            ];
        }

        // Check if user is authenticated
        if (Auth::check() && $product instanceof Product) {
            // For authenticated users with real products, store in database
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                // Item already exists, increment quantity
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                // Create new cart item
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }
        } else {
            // For guests or products not in DB, store in session
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'name' => $product->name ?? 'Product #' . $productId,
                    'price' => $product->price ?? 0.00,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', ($product->name ?? 'Product') . ' has been added to your basket!');
    }

    /**
     * Display the basket.
     */
    public function index()
    {
        if (Auth::check()) {
            // Get cart items from database for authenticated users
            $cartItems = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            // Get cart items from session for guests
            $cartItems = collect(session()->get('cart', []))->map(function ($item, $productId) {
                return (object) [
                    'id' => $productId,
                    'product_id' => $productId,
                    'product' => (object) [
                        'id' => $productId,
                        'name' => $item['name'],
                        'price' => $item['price'],
                    ],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ];
            });
        }

        $total = $cartItems->sum(function ($item) {
            return Auth::check() ? $item->total : $item->total;
        });

        return view('basket.index', compact('cartItems', 'total'));
    }

    /**
     * Update the quantity of a cart item.
     */
    public function update(Request $request, int $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->firstOrFail();

            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $request->quantity;
                session()->put('cart', $cart);
            }
        }

        return back()->with('success', 'Basket updated successfully!');
    }

    /**
     * Remove an item from the basket.
     */
    public function remove(int $productId)
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed from basket!');
    }

    /**
     * Clear the entire basket.
     */
    public function clear()
    {
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        return back()->with('success', 'Basket cleared!');
    }

    /**
     * Get the cart item count.
     */
    public function count()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }
}