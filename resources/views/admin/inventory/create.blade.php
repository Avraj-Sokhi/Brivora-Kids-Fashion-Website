@extends('layouts.app')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Adjust Stock: {{ $product->name }}</h1>
        </div>
    </header>

    <x-nav />

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Current Stock Info --}}
            <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Current Stock Level</h2>
                    <div class="flex items-center gap-6">
                        <div>
                            <span class="text-4xl font-bold
                                @if($product->stock_quantity <= 0) text-red-600
                                @elseif($product->stock_quantity <= $product->low_stock_threshold) text-yellow-600
                                @else text-green-600 @endif">
                                {{ $product->stock_quantity }}
                            </span>
                            <span class="text-gray-500 text-sm ml-1">units</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            Low Stock Threshold: <strong>{{ $product->low_stock_threshold }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Adjustment Form --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Record Stock Change</h2>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.inventory.store', $product->id) }}">
                        @csrf

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Action Type *</label>
                                <select name="action_type" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="incoming" {{ old('action_type') === 'incoming' ? 'selected' : '' }}>📦 Incoming (Add Stock)</option>
                                    <option value="outgoing" {{ old('action_type') === 'outgoing' ? 'selected' : '' }}>📤 Outgoing (Remove Stock)</option>
                                    <option value="adjustment" {{ old('action_type') === 'adjustment' ? 'selected' : '' }}>🔧 Adjustment (Set to Value)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                                <input type="number" name="quantity" value="{{ old('quantity') }}" min="1" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Supplier Name (optional)</label>
                            <input type="text" name="supplier_name" value="{{ old('supplier_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="e.g. Fashion Wholesale Ltd">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes (optional)</label>
                            <textarea name="notes" rows="2"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="e.g. Spring 2026 delivery batch">{{ old('notes') }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Products</a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                Update Stock
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Recent Inventory Activity --}}
            @if($logs->isNotEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Recent Activity</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Change</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Result</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">By</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($logs as $log)
                                <tr>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $log->created_at->format('M d, H:i') }}</td>
                                    <td class="px-4 py-2 text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            @if($log->action_type === 'incoming') bg-green-100 text-green-800
                                            @elseif($log->action_type === 'outgoing') bg-red-100 text-red-800
                                            @else bg-blue-100 text-blue-800 @endif">
                                            {{ ucfirst($log->action_type) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-sm font-medium {{ $log->quantity_change >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $log->quantity_change >= 0 ? '+' : '' }}{{ $log->quantity_change }}
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $log->previous_quantity }} → {{ $log->new_quantity }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-500">{{ $log->user->name ?? 'System' }}</td>
                                    <td class="px-4 py-2 text-sm text-gray-400">{{ Str::limit($log->notes, 30) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
@endsection
