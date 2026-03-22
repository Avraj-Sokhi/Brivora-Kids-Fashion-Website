@extends('layouts.app')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
        </div>
    </header>

    <x-nav />

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.products.store') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <textarea name="description" rows="3" required
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                        </div>

                        {{-- Price & Category Row --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price (£) *</label>
                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0.01" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                                <select name="category_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Gender & Status Row --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gender *</label>
                                <select name="gender_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Gender</option>
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}" {{ old('gender_id') == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                                <select name="status" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        {{-- Stock Row --}}
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
                                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Low Stock Threshold *</label>
                                <input type="number" name="low_stock_threshold" value="{{ old('low_stock_threshold', 10) }}" min="0" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>

                        {{-- Image URL --}}
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL (optional)</label>
                            <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="images/products/example.jpg"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        {{-- Sizes Section --}}
                        <div class="mb-6 border-t pt-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-3">Sizes & Stock (Optional)</h3>
                            <div id="sizes-container">
                                {{-- Dynamic size rows will be added here --}}
                            </div>
                            <button type="button" onclick="addSizeRow()"
                                    class="mt-2 inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                + Add Size
                            </button>
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Products</a>
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700">
                                Create Product
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        let sizeIndex = 0;
        function addSizeRow(size = '', qty = 0) {
            const container = document.getElementById('sizes-container');
            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 mb-2';
            row.innerHTML = `
                <input type="text" name="sizes[${sizeIndex}][size]" value="${size}" placeholder="e.g. S, M, L, 3-4Y"
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <input type="number" name="sizes[${sizeIndex}][stock_quantity]" value="${qty}" min="0" placeholder="Stock"
                       class="w-24 px-3 py-2 border border-gray-300 rounded-md text-sm">
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 text-lg font-bold">×</button>
            `;
            container.appendChild(row);
            sizeIndex++;
        }
    </script>
@endsection
