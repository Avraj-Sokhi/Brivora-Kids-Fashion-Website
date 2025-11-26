<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // For now, just return the Blade view.
        // Later we can add database queries and filtering logic.
        return view('products');
    }
}