<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\CartItem;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Merge session cart with database cart
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            $userId = Auth::id();

            foreach ($sessionCart as $productId => $item) {
                // Check if item already exists in user's DB cart
                $cartItem = CartItem::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartItem) {
                    // If item exists in DB, add session quantity to it
                    $cartItem->quantity += $item['quantity'];
                    $cartItem->save();
                } else {
                    // If item doesn't exist, create it
                    CartItem::create([
                        'user_id' => $userId,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                    ]);
                }
            }

            // Clear the session cart after merging
            session()->forget('cart');
        }

        $user = $request->user();

        //force first time password change
        if ($user->must_change_password) {
            return redirect()->route('password.change.form');
        }
        // redirect admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        //redirect customers
        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
