<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\InventoryLog;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Summary counts
        $totalProducts = Product::where('status', '!=', 'discontinued')->count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // Stock alerts
        $lowStockProducts = Product::with('category')
            ->where('status', 'active')
            ->whereColumn('stock_quantity', '<=', 'low_stock_threshold')
            ->where('stock_quantity', '>', 0)
            ->orderBy('stock_quantity')
            ->get();

        $outOfStockProducts = Product::with('category')
            ->where('status', 'active')
            ->where('stock_quantity', '<=', 0)
            ->get();

        // Orders by status
        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Revenue
        $totalRevenue = Order::whereIn('status', ['processing', 'shipped', 'delivered'])
            ->sum('total_amount');

        // Recent inventory logs
        $recentLogs = InventoryLog::with(['product', 'user'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'lowStockProducts',
            'outOfStockProducts',
            'ordersByStatus',
            'totalRevenue',
            'recentLogs'
        ));
    }
}
