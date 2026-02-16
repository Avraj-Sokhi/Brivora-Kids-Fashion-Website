<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $order = Order::create([
            'order_number' => uniqid('ORD-'),
            'user_id' => $request->user_id,
            'address_id' => $request->address_id,
            'total_amount' => 0,
            'discount_amount' => 0,
        ]);

        $total = 0;

        foreach ($request->items as $item) {

            $size = ProductSize::find($item['size_id']);

            // Deduct stock
            $size->reduceStock($item['quantity']);

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $size->product_id,
                'size_id' => $size->id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['unit_price'] * $item['quantity'],
            ]);

            $total += $item['unit_price'] * $item['quantity'];

            // Check for low stock
            if ($size->isLowStock()) {
                $this->triggerRestock($size);
            }
        }

        $order->update(['total_amount' => $total]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ]);
    }

    private function triggerRestock(ProductSize $size)
    {
        \Log::info("Low stock alert: Product {$size->product->name} (Size {$size->size}) is low on stock.");
    }
}
