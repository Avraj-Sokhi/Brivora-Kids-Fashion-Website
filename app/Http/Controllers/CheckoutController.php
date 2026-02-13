<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        return view('checkout', compact('cartItems', 'total'));
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

        // Create address
        $address = Address::create([
            'user_id' => Auth::id(),
            'address_line1' => $validated['address_line1'],
            'address_line2' => $validated['address_line2'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'country' => $validated['country'],
            'is_default' => false,
        ]);

        // Create order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => Auth::id(),
            'address_id' => $address->id,
            'total_amount' => $total,
            'discount_amount' => 0.00,
            'status' => 'processing',
            'payment_method' => 'card', // Dummy payment method
            'order_date' => now(),
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => Auth::check() ? $item->product->id : $item->product->id,
                'size_id' => null, // You can add size selection later
                'quantity' => $item->quantity,
                'unit_price' => Auth::check() ? $item->product->price : $item->product->price,
                'subtotal' => Auth::check() ? $item->total : $item->total,
            ]);
        }

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
