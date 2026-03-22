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

        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        $order->status = $newStatus;

        if ($newStatus === 'shipped' && is_null($order->shipped_date)) {
            $order->shipped_date = now();
        }

        if ($newStatus === 'delivered' && is_null($order->delivered_date)) {
            $order->delivered_date = now();
        }

        // Restore stock when order is returned or cancelled (only if it wasn't already)
        $restoreStatuses = ['returned', 'cancelled'];
        if (in_array($newStatus, $restoreStatuses) && !in_array($oldStatus, $restoreStatuses)) {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->increment('stock_quantity', $item->quantity);
                }
            }
        }

        $order->save();

        return Redirect::route('admin.orders.index')->with('status', 'Order status updated successfully.');
    }
}
