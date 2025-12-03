@extends('layouts.app')

@section('content')
    <header>
        <h1>Your Shopping Basket</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 m-4 rounded-lg text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Basket Content --}}
    <section class="p-8 max-w-5xl mx-auto">
        @if($cartItems->isEmpty())
            <div class="text-center p-12 bg-blue-50 rounded-2xl border-4 border-dashed border-blue-500">
                <h2 class="text-blue-600 font-fredoka text-4xl mb-4">Your basket is empty!</h2>
                <p class="mb-6 text-lg">Add some awesome products to get started.</p>
                <a href="{{ route('products.index') }}" class="btn inline-block mt-4 no-underline">
                    Continue Shopping
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl p-8 border-4 border-blue-500 shadow-lg">
                <table class="w-full">
                    <thead>
                        <tr class="bg-blue-500 text-white">
                            <th class="p-4 text-left font-fredoka">Product</th>
                            <th class="p-4 text-center font-fredoka">Price</th>
                            <th class="p-4 text-center font-fredoka">Quantity</th>
                            <th class="p-4 text-center font-fredoka">Total</th>
                            <th class="p-4 text-center font-fredoka">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr class="border-b-2 border-gray-300">
                                <td class="p-4">
                                    <strong class="text-red-400 text-lg">{{ $item->product->name }}</strong>
                                </td>
                                <td class="p-4 text-center">
                                    £{{ number_format($item->product->price, 2) }}
                                </td>
                                <td class="p-4 text-center">
                                    <form method="POST" action="{{ route('basket.update', $item->product_id) }}"
                                        class="inline-flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                            class="w-16 px-2 py-1 border-2 border-red-400 rounded-lg text-center font-comic-neue">
                                        <button type="submit" class="btn px-3 py-1 text-sm">Update</button>
                                    </form>
                                </td>
                                <td class="p-4 text-center font-bold text-green-600 text-lg">
                                    £{{ number_format(Auth::check() ? $item->total : $item->total, 2) }}
                                </td>
                                <td class="p-4 text-center">
                                    <form method="POST" action="{{ route('basket.remove', $item->product_id) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn bg-red-600 px-4 py-2"
                                            onclick="return confirm('Remove this item?')">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Basket Summary --}}
                <div class="mt-8 p-6 bg-yellow-50 rounded-lg border-2 border-red-400">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-fredoka text-red-400 text-2xl">Basket Total:</h3>
                        <h3 class="font-fredoka text-green-600 text-4xl">
                            £{{ number_format($total, 2) }}</h3>
                    </div>

                    <div class="flex gap-4 justify-end flex-wrap">
                        <form method="POST" action="{{ route('basket.clear') }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red-600"
                                onclick="return confirm('Clear entire basket?')">
                                Clear Basket
                            </button>
                        </form>

                        <a href="{{ route('products.index') }}" class="btn bg-blue-500 no-underline inline-block">
                            Continue Shopping
                        </a>

                        <a href="{{ route('checkout.index') }}" class="btn bg-green-600 no-underline inline-block text-lg px-6 py-3">
                            Proceed to Checkout
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </section>

    <style>
        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }

            th,
            td {
                padding: 0.5rem !important;
            }

            .btn {
                padding: 0.4rem 0.8rem !important;
                font-size: 0.85rem !important;
            }
        }
    </style>
@endsection