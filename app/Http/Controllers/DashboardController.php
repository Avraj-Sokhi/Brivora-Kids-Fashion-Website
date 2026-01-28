<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = Str::headline('dashboard');

        $totalProducts = DB::table('products')->count();
        $totalCustomers = DB::table('customers')->count();
        $totalOrders = DB::table('orders')->count();
        $awaitingProcessing = DB::table('orders')->where('status', 'pending')->count();

        $lowStockProducts = DB::table('products')
            ->select('name', 'sku', 'stock_quantity')
            ->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->orderBy('stock_quantity')
            ->limit(10)
            ->get();

        $lowStockCount = $lowStockProducts->count();

        return view('admin.dashboard', compact(
            'title',
            'totalProducts',
            'totalCustomers',
            'totalOrders',
            'awaitingProcessing',
            'lowStockProducts',
            'lowStockCount'
        ));
    }
}
