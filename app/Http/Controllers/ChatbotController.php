<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ChatbotController extends Controller
{
    public function handle(Request $request)
{
    $message = strtolower(trim($request->message));
    $reply = "Sorry, I didn't understand that. Try asking about products, stock, orders, returns, or contact.";

    // Products / categories
    if (
        str_contains($message, 'product') ||
        str_contains($message, 'category') ||
        str_contains($message, 'sell') ||
        str_contains($message, 'browse products')
    ) {
        $reply = "We sell kids' tops, trousers, outerwear, shoes, and accessories for boys and girls.";
    }

    // Stock help prompt
    elseif ($message === 'check stock') {
        $reply = "Sure! Tell me the name of the item you want to check, for example: 'is Minecraft Beanie in stock?' or 'How many Puffer Jackets are in stock?'";
    }

    // Orders
    elseif (
        str_contains($message, 'order') ||
        str_contains($message, 'track')
    ) {
        $reply = "You can view and track your orders from your account order history page after logging in.";
    }

    // Returns
    elseif (
        str_contains($message, 'return') ||
        str_contains($message, 'returns help')
    ) {
        $reply = "Items can be returned through your order history page, depending on the return policy.";
    }

    // Contact
    elseif (
        str_contains($message, 'contact') ||
        str_contains($message, 'support') ||
        str_contains($message, 'help')
    ) {
        $reply = "You can contact the Brivora team through the Contact Us page.";
    }

    // Stock / product lookup
    else {
        $cleanMessage = $message;

        $phrasesToRemove = [
            'is ',
            'are ',
            'do you have ',
            'how many ',
            'what about ',
            'in stock',
            'stock',
            'available',
            'left'
        ];

        foreach ($phrasesToRemove as $phrase) {
            $cleanMessage = str_replace($phrase, '', $cleanMessage);
        }

        $cleanMessage = trim($cleanMessage);

        $product = \App\Models\Product::where('name', 'like', "%{$cleanMessage}%")->first();

        if ($product) {
            if (str_contains($message, 'how many') || str_contains($message, 'left')) {
                $reply = "{$product->name} currently has {$product->stock_quantity} items in stock.";
            } elseif ($product->stock_quantity > $product->low_stock_threshold) {
                $reply = "{$product->name} is currently in stock.";
            } elseif ($product->stock_quantity > 0) {
                $reply = "{$product->name} is low in stock. Only {$product->stock_quantity} left.";
            } else {
                $reply = "{$product->name} is currently out of stock.";
            }
        }
    }

    return response()->json([
        'reply' => $reply
    ]);
}
}