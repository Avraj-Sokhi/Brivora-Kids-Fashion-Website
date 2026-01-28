<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
<div class="min-h-screen flex">
    <aside class="w-64 bg-gray-900 text-gray-100 hidden md:flex md:flex-col">
        <div class="px-5 py-4 font-semibold text-lg border-b border-gray-800">Admin Dashboard</div>
        <nav class="py-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block mx-3 px-3 py-2 rounded-lg bg-gray-800 text-white">Dashboard</a>
            <a href="{{ route('admin.products') }}" class="block mx-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800">Products</a>
            <a href="{{ route('admin.orders') }}" class="block mx-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800">Orders</a>
            <a href="{{ route('admin.customers') }}" class="block mx-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800">Customers</a>
            <a href="{{ route('admin.reports') }}" class="block mx-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800">Reports</a>
            <a href="{{ route('admin.settings') }}" class="block mx-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800">Settings</a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <div class="text-lg font-semibold">{{ $title }}</div>
            <div class="flex items-center gap-3">
                <div class="text-sm text-gray-500">Signed in as Super Admin</div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 rounded-lg bg-gray-900 text-white text-sm hover:bg-gray-800">Logout</button>
                </form>
            </div>
        </header>

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="text-xs text-gray-500">Total Products</div>
                    <div class="mt-1 text-3xl font-bold">{{ $totalProducts }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="text-xs text-gray-500">Total Customers</div>
                    <div class="mt-1 text-3xl font-bold">{{ $totalCustomers }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="text-xs text-gray-500">Total Orders</div>
                    <div class="mt-1 text-3xl font-bold">{{ $totalOrders }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="text-xs text-gray-500">Awaiting Processing</div>
                    <div class="mt-1 text-3xl font-bold">{{ $awaitingProcessing }}</div>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-4">
                    <div class="text-xs text-gray-500">Low Stock Alerts</div>
                    <div class="mt-1 text-3xl font-bold">{{ $lowStockCount }}</div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-base font-semibold mb-4">Low Stock Alerts</h2>
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">SKU</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Stock</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($lowStockProducts as $product)
                                <tr>
                                    <td class="px-4 py-3">{{ $product->name }}</td>
                                    <td class="px-4 py-3">{{ $product->sku }}</td>
                                    <td class="px-4 py-3">{{ $product->stock_quantity }}</td>
                                    <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Low</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-gray-500">No low stock products</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
