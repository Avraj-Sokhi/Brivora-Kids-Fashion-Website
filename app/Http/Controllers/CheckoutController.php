<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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
        if (Auth::check()) {
            // For authenticated users, get cart items from database
            $cartItems = CartItem::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            // For guests, get cart items from session
            $sessionCart = Session::get('cart', []);
            $cartItems = collect($sessionCart)->map(function ($item) {
                return (object) [
                    'product' => (object) [
                        'name' => $item['name'],
                        'price' => $item['price'],
                    ],
                    'quantity' => $item['quantity'],
                    'total' => $item['price'] * $item['quantity'],
                ];
            });
        }

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return Auth::check() ? $item->total : $item->total;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Process the checkout (dummy implementation).
     */
    public function process(Request $request)
    {
        // In a real application, you would:
        // 1. Validate the form data
        // 2. Process the payment
        // 3. Create an order record
        // 4. Clear the cart
        // 5. Send confirmation email
        // 6. Redirect to order confirmation page

        // For now, just redirect back with a success message
        return redirect()->route('products.index')->with('success', 'Order placed successfully! (Demo mode)');
    }
}
