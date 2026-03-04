@extends('layouts.app')

@section('content')
  <header>
    <h1>My Orders</h1>
  </header>

  {{-- Navigation --}}
  <x-nav />

  {{-- Success Message --}}
  @if(session('success'))
    <div class="max-w-7xl mx-auto px-8 mt-4">
      <div
        style="background: #4caf50; color: white; padding: 1.5rem; border-radius: 15px; text-align: center; font-family: 'Comic Neue', cursive; font-size: 1.2rem; animation: slideDown 0.3s ease-out; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
        {{ session('success') }}
      </div>
    </div>
  @endif

  <style>
    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

  <section class="max-w-7xl mx-auto my-8 p-8">
    @if($orders->isEmpty())
      {{-- No Orders State --}}
      <div class="text-center p-12 bg-blue-50 rounded-3xl border-4 border-dashed border-blue-500 shadow-md">
        <div class="text-8xl mb-4"></div>
        <h2 class="text-red-400 font-fredoka text-4xl mb-4">
          No orders yet!
        </h2>
        <p class="my-4 text-lg text-gray-600">
          Start shopping to see your orders here.
        </p>
        <a href="{{ route('products.index') }}" class="btn inline-block mt-4 no-underline text-lg px-8 py-3">
          Browse Products
        </a>
      </div>
    @else
      {{-- Orders List --}}
      <div class="flex flex-col gap-6">
        @foreach($orders as $order)
          <div class="bg-white rounded-3xl p-6 border-4 border-blue-500 shadow-xl hover:shadow-2xl transition-shadow">
            {{-- Order Header --}}
            <div class="flex flex-wrap justify-between items-start mb-6 pb-4 border-b-2 border-gray-200">
              <div>
                <h3 class="font-fredoka text-blue-500 text-2xl mb-2">
                  Order #{{ $order->order_number }}
                </h3>
                <p class="text-gray-600">
                  <strong>Order Date:</strong> {{ $order->order_date->format('d M Y, h:i A') }}
                </p>
                <p class="text-gray-600">
                  <strong>Status:</strong>
                  <span class="
                          @if($order->status === 'delivered') text-green-600
                          @elseif($order->status === 'shipped') text-blue-600
                          @elseif($order->status === 'processing') text-yellow-600
                          @elseif($order->status === 'cancelled') text-red-600
                          @else text-gray-600
                          @endif
                          font-bold uppercase
                        ">
                    {{ ucfirst($order->status) }}
                  </span>
                </p>
              </div>
              <div class="text-right">
                <p class="text-gray-600 mb-2">Total Amount</p>
                <p class="font-fredoka text-green-600 text-3xl">
                  £{{ number_format($order->total_amount, 2) }}
                </p>
              </div>
            </div>

            {{-- Order Items --}}
            <div class="mb-4">
              <h4 class="font-fredoka text-red-400 text-xl mb-4">Order Items ({{ $order->items->count() }})</h4>
              <div class="flex flex-col gap-3">
                @foreach($order->items as $item)
                  <div class="flex items-center gap-4 p-3 bg-blue-50 rounded-xl border-2 border-gray-300">
                    {{-- Product Image --}}
                    @if($item->product->images->isNotEmpty())
                      <img src="{{ asset($item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}"
                        class="w-16 h-16 object-cover rounded-lg flex-shrink-0 shadow-md" loading="lazy">
                    @else
                      <div
                        class="w-16 h-16 bg-gradient-to-br from-red-400 to-pink-500 rounded-lg flex-shrink-0 flex items-center justify-center text-white text-3xl">
                        👕
                      </div>
                    @endif

                    {{-- Product Details --}}
                    <div class="flex-1">
                      <h5 class="m-0 font-fredoka text-red-400 text-lg">
                        {{ $item->product->name }}
                      </h5>
                      <p class="m-0 text-gray-600 text-sm">
                        Quantity: <strong>{{ $item->quantity }}</strong> × £{{ number_format($item->unit_price, 2) }}
                      </p>
                    </div>

                    {{-- Item Total --}}
                    <div class="text-right">
                      <p class="m-0 text-green-600 font-bold text-lg">
                        £{{ number_format($item->subtotal, 2) }}
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Delivery Information --}}
            @if($order->address)
              <div class="mt-4 p-4 bg-yellow-50 rounded-lg border-2 border-dashed border-red-400">
                <h5 class="font-fredoka text-blue-500 text-lg mb-2">Delivery Address</h5>
                <p class="text-gray-700 text-sm mb-1">
                  {{ $order->address->address_line1 }}
                  @if($order->address->address_line2), {{ $order->address->address_line2 }}@endif
                </p>
                <p class="text-gray-700 text-sm">
                  {{ $order->address->city }}, {{ $order->address->postal_code }}
                </p>
                <p class="text-gray-700 text-sm">
                  {{ $order->address->country }}
                </p>
              </div>
            @endif

            {{-- Order Timeline --}}
            <div class="mt-4 flex flex-wrap gap-4 text-sm text-gray-600">
              @if($order->shipped_date)
                <div>
                  <strong>Shipped:</strong> {{ $order->shipped_date->format('d M Y') }}
                </div>
              @endif
              @if($order->delivered_date)
                <div>
                  <strong>Delivered:</strong> {{ $order->delivered_date->format('d M Y') }}
                </div>
              @endif
            </div>

            {{-- View Details Button --}}
            <div class="mt-4 text-right">
              <a href="{{ route('orders.show', $order->id) }}"
                class="btn inline-block no-underline bg-blue-500 hover:bg-blue-600">
                View Full Details
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </section>

  <style>
    @media (max-width: 768px) {
      .flex-wrap {
        flex-direction: column;
        align-items: flex-start !important;
      }

      .text-right {
        text-align: left !important;
      }
    }
  </style>
@endsection