<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'address', 'items'])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update the specified order status.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:processing,shipped,delivered,cancelled,returned'],
        ]);

        $order->status = $validated['status'];

        if ($validated['status'] === 'shipped' && is_null($order->shipped_date)) {
            $order->shipped_date = now();
        }

        if ($validated['status'] === 'delivered' && is_null($order->delivered_date)) {
            $order->delivered_date = now();
        }

        $order->save();

        return Redirect::route('admin.orders.index')->with('status', 'Order status updated successfully.');
    }
}
