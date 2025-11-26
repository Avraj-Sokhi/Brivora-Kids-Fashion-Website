<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function add(Request $request, int $productId)
    {
        // For now, we just show a message.
        // Later we can store basket items in session or database.
        return back()->with('status', 'Product '.$productId.' added to basket!');
    }
}