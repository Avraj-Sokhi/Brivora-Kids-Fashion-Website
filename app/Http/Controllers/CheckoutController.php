<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        // Require authentication for checkout
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login or register to complete your order.');
        }

        // For authenticated users, get cart items from database
        $cartItems = CartItem::with(['product.images'])
            ->where('user_id', Auth::id())
            ->get();

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return Auth::check() ? $item->total : $item->total;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Process the checkout (save order to database).
     */
    public function process(Request $request)
    {
        // Validate delivery information
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        // Get cart items
        if (Auth::check()) {
            $cartItems = CartItem::with(['product.images'])
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $sessionCart = Session::get('cart', []);
            $cartItems = collect($sessionCart)->map(function ($item) {
                return (object) [
                    'product' => (object) [
                        'id' => $item['product_id'] ?? null,
                        'name' => $item['name'],
                        'price' => $item['price'],
                    ],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ];
            });
        }

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->route('basket.index')->with('error', 'Your basket is empty!');
        }

        // Pre-validate stock for all items before checkout
        foreach ($cartItems as $item) {
            if (!$item->product) continue;
            
            $productModel = \App\Models\Product::find($item->product->id);
            if (!$productModel || $productModel->stock_quantity < $item->quantity) {
                $productName = $productModel ? $productModel->name : ($item->product->name ?? 'An item');
                $available = $productModel ? $productModel->stock_quantity : 0;
                return redirect()->route('basket.index')->with('error', "Sorry, '{$productName}' does not have enough stock ({$available} available). Please update your basket.");
            }
        }

        // Calculate total
        $subtotal = $cartItems->sum(function ($item) {
            return Auth::check() ? $item->total : $item->total;
        });
        $tax = $subtotal * 0.2; // 20% VAT
        $total = $subtotal + $tax;

        // Create or get user
        if (!Auth::check()) {
            // For guest checkout, we need a user account
            // In a real app, you might create a guest user or require login
            return redirect()->route('login')->with('error', 'Please login to complete your order.');
        }

        $order = DB::transaction(function () use ($validated, $total, $cartItems) {
            $address = Address::create([
                'user_id' => Auth::id(),
                'address_line1' => $validated['address_line1'],
                'address_line2' => $validated['address_line2'],
                'city' => $validated['city'],
                'postal_code' => $validated['postal_code'],
                'country' => $validated['country'],
                'is_default' => false,
            ]);

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => Auth::id(),
                'address_id' => $address->id,
                'total_amount' => $total,
                'discount_amount' => 0.00,
                'status' => 'processing',
                'payment_method' => 'card',
                'order_date' => now(),
            ]);

            foreach ($cartItems as $item) {
                $product = Product::query()
                    ->whereKey($item->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$product || $product->status !== 'active') {
                    throw ValidationException::withMessages([
                        'basket' => 'One or more products are no longer available. Please refresh your basket.',
                    ]);
                }

                if ($product->stock_quantity < $item->quantity) {
                    throw ValidationException::withMessages([
                        'basket' => "Insufficient stock for {$product->name}. Please reduce quantity and try again.",
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size_id' => $item->size_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $product->price * $item->quantity,
                ]);

                $product->decrement('stock_quantity', $item->quantity);
            }

            return $order;
        });

        // Clear the basket
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            Session::forget('cart');
        }

        // Redirect to orders page with success message
        return redirect()->route('orders.index')->with('success', '🎉 Order placed successfully! Your order number is: ' . $order->order_number);
    }
}
