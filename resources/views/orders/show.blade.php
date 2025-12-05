@extends('layouts.app')

@section('content')
    <header>
        <h1>Order Details</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    <section class="max-w-5xl mx-auto my-8 p-8">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-blue-500 hover:text-blue-700 font-bold no-underline">
                ← Back to My Orders
            </a>
        </div>

        {{-- Order Details Card --}}
        <div class="bg-white rounded-3xl p-8 border-4 border-blue-500 shadow-xl">
            {{-- Order Header --}}
            <div class="mb-6 pb-6 border-b-2 border-gray-200">
                <h2 class="font-fredoka text-blue-500 text-4xl mb-4">
                    Order #{{ $order->order_number }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 mb-2">
                            <strong>Order Date:</strong> {{ $order->order_date->format('d M Y, h:i A') }}
                        </p>
                        <p class="text-gray-600 mb-2">
                            <strong>Status:</strong>
                            <span class="
                    @if($order->status === 'delivered') text-green-600
                    @elseif($order->status === 'shipped') text-blue-600
                    @elseif($order->status === 'processing') text-yellow-600
                    @elseif($order->status === 'cancelled') text-red-600
                    @else text-gray-600
                    @endif
                    font-bold uppercase text-lg
                  ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        @if($order->payment_method)
                            <p class="text-gray-600 mb-2">
                                <strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}
                            </p>
                        @endif
                    </div>

                    <div class="text-left md:text-right">
                        <p class="text-gray-600 mb-2">Order Total</p>
                        <p class="font-fredoka text-green-600 text-5xl">
                            £{{ number_format($order->total_amount, 2) }}
                        </p>
                        @if($order->discount_amount > 0)
                            <p class="text-red-500 text-sm">
                                Discount Applied: -£{{ number_format($order->discount_amount, 2) }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Order Timeline --}}
            <div class="mb-6 pb-6 border-b-2 border-gray-200">
                <h3 class="font-fredoka text-red-400 text-2xl mb-4">Order Timeline</h3>
                <div class="flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                            ✓
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Order Placed</p>
                            <p class="text-sm text-gray-600">{{ $order->order_date->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>

                    @if($order->shipped_date)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                ✓
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Shipped</p>
                                <p class="text-sm text-gray-600">{{ $order->shipped_date->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold">
                                ○
                            </div>
                            <div>
                                <p class="font-bold text-gray-400">Awaiting Shipment</p>
                            </div>
                        </div>
                    @endif

                    @if($order->delivered_date)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center text-white font-bold">
                                ✓
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Delivered</p>
                                <p class="text-sm text-gray-600">{{ $order->delivered_date->format('d M Y, h:i A') }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-white font-bold">
                                ○
                            </div>
                            <div>
                                <p class="font-bold text-gray-400">Pending Delivery</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Order Items --}}
            <div class="mb-6 pb-6 border-b-2 border-gray-200">
                <h3 class="font-fredoka text-red-400 text-2xl mb-4">
                    Order Items ({{ $order->items->count() }})
                </h3>
                <div class="flex flex-col gap-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-6 p-4 bg-blue-50 rounded-2xl border-2 border-gray-300">
                            {{-- Product Image --}}
                            @if($item->product->images->isNotEmpty())
                                <img src="{{ asset($item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}"
                                    class="w-24 h-24 object-cover rounded-xl flex-shrink-0 shadow-md" loading="lazy">
                            @else
                                <div
                                    class="w-24 h-24 bg-gradient-to-br from-red-400 to-pink-500 rounded-xl flex-shrink-0 flex items-center justify-center text-white text-4xl">
                                    👕
                                </div>
                            @endif

                            {{-- Product Details --}}
                            <div class="flex-1">
                                <h4 class="m-0 mb-2 font-fredoka text-red-400 text-xl">
                                    {{ $item->product->name }}
                                </h4>
                                <p class="m-0 text-gray-600">
                                    <strong>Quantity:</strong> {{ $item->quantity }}
                                </p>
                                <p class="m-0 text-gray-600">
                                    <strong>Unit Price:</strong> £{{ number_format($item->unit_price, 2) }}
                                </p>
                                @if($item->size)
                                    <p class="m-0 text-gray-600">
                                        <strong>Size:</strong> {{ $item->size->name }}
                                    </p>
                                @endif
                            </div>

                            {{-- Item Total --}}
                            <div class="text-right">
                                <p class="m-0 text-green-600 font-fredoka text-2xl">
                                    £{{ number_format($item->subtotal, 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Delivery Address --}}
            @if($order->address)
                <div class="mb-6">
                    <h3 class="font-fredoka text-red-400 text-2xl mb-4">Delivery Address</h3>
                    <div class="p-6 bg-yellow-50 rounded-2xl border-2 border-red-400">
                        <p class="text-gray-800 font-bold text-lg mb-2">{{ $order->user->name }}</p>
                        <p class="text-gray-700 mb-1">{{ $order->address->address_line1 }}</p>
                        @if($order->address->address_line2)
                            <p class="text-gray-700 mb-1">{{ $order->address->address_line2 }}</p>
                        @endif
                        <p class="text-gray-700 mb-1">{{ $order->address->city }}, {{ $order->address->postal_code }}</p>
                        <p class="text-gray-700">{{ $order->address->country }}</p>
                    </div>
                </div>
            @endif

            {{-- Order Summary --}}
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl p-6 text-white">
                <h3 class="font-fredoka text-3xl mb-4">Order Summary</h3>
                <div class="flex justify-between mb-3 text-lg">
                    <span>Subtotal:</span>
                    <span
                        class="font-bold">£{{ number_format($order->total_amount - ($order->total_amount * 0.2), 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                    <div class="flex justify-between mb-3 text-lg text-yellow-300">
                        <span>Discount:</span>
                        <span class="font-bold">-£{{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between mb-3 text-lg">
                    <span>VAT (20%):</span>
                    <span class="font-bold">£{{ number_format($order->total_amount * 0.2, 2) }}</span>
                </div>
                <div class="flex justify-between mb-3 text-lg">
                    <span>Shipping:</span>
                    <span class="font-bold text-green-300">FREE</span>
                </div>
                <div class="border-t-2 border-dashed border-white/50 pt-4 mt-4">
                    <div class="flex justify-between text-2xl">
                        <span class="font-fredoka">Total:</span>
                        <span class="font-fredoka text-yellow-300">£{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: 1fr;
            }

            .md\:text-right {
                text-align: left !important;
            }
        }
    </style>
@endsection