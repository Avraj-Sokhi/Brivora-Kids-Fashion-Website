<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display the user's orders.
     */
    public function index()
    {
        // Get all orders for the authenticated user with related data
        $orders = Order::with(['items.product.images', 'address'])
            ->where('user_id', Auth::id())
            ->orderBy('order_date', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Display a specific order.
     */
    public function show($id)
    {
        // Get the order with all related data
        $order = Order::with(['items.product.images', 'address'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('orders.show', compact('order'));
    }
}
