@extends('layouts.app')

@section('content')
  <header>
    <h1>Checkout</h1>
  </header>

  {{-- Navigation --}}
  <x-nav />

  <section class="max-w-7xl mx-auto my-8 p-8">
    @if($cartItems->isEmpty())
      {{-- Empty Basket State --}}
      <div class="text-center p-12 bg-blue-50 rounded-3xl border-4 border-dashed border-blue-500 shadow-md">
        <div class="text-8xl mb-4">🛒</div>
        <h2 class="text-red-400 font-fredoka text-4xl mb-4">
          Your basket is empty!
        </h2>
        <p class="my-4 text-lg text-gray-600">
          Add some awesome products before checking out.
        </p>
        <a href="{{ route('products.index') }}" class="btn inline-block mt-4 no-underline text-lg px-8 py-3">
          Browse Products
        </a>
      </div>
    @else
      <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

          {{-- Left Column: Order Items & Customer Info --}}
          <div class="lg:col-span-2 flex flex-col gap-8">

            {{-- Order Items --}}
            <div class="bg-white rounded-3xl p-8 border-4 border-blue-500 shadow-xl">
              <h2 class="font-fredoka text-blue-500 text-4xl mb-6">
                Your Order ({{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'items' }})
              </h2>

              <div class="flex flex-col gap-4">
                @foreach($cartItems as $item)
                  <div class="flex items-center gap-6 p-4 bg-blue-50 rounded-2xl border-2 border-gray-300">
                    {{-- Product Image --}}
                    @if($item->product->images->isNotEmpty())
                      <img src="{{ asset($item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}"
                        class="w-20 h-20 object-cover rounded-xl flex-shrink-0 shadow-md" loading="lazy">
                    @else
                      <div class="w-20 h-20 bg-gradient-to-br from-red-400 to-pink-500 rounded-xl flex-shrink-0 flex items-center justify-center text-white text-4xl">
                        👕
                      </div>
                    @endif

                    <div class="flex-1">
                      <h4 class="m-0 mb-2 font-fredoka text-red-400 text-xl">
                        {{ $item->product->name }}
                      </h4>
                      <p class="m-0 text-gray-600 text-sm">
                        Quantity: <strong>{{ $item->quantity }}</strong>
                      </p>
                      <p class="mt-1 text-blue-500 font-bold">
                        £{{ number_format($item->product->price, 2) }} each
                      </p>
                    </div>

                    <div class="text-right">
                      <p class="m-0 text-green-600 font-fredoka text-2xl">
                        £{{ number_format($item->total, 2) }}
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Delivery Information --}}
            <div class="bg-white rounded-3xl p-8 border-4 border-red-400 shadow-xl">
              <h2 class="font-fredoka text-red-400 text-4xl mb-6">
                Delivery Information
              </h2>

              <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                  <label class="block font-fredoka text-blue-500 mb-2">Full Name *</label>
                  <input type="text" name="name" required value="{{ Auth::check() ? Auth::user()->name : '' }}"
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="John Doe">
                </div>

                <div>
                  <label class="block font-fredoka text-blue-500 mb-2">Email *</label>
                  <input type="email" name="email" required value="{{ Auth::check() ? Auth::user()->email : '' }}"
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="john@example.com">
                </div>

                <div>
                  <label class="block font-fredoka text-blue-500 mb-2">Phone *</label>
                  <input type="tel" name="phone" required
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="+44 123 456 7890">
                </div>

                <div class="col-span-2">
                  <label class="block font-fredoka text-blue-500 mb-2">Address Line 1 *</label>
                  <input type="text" name="address_line1" required
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="123 Main Street">
                </div>

                <div class="col-span-2">
                  <label class="block font-fredoka text-blue-500 mb-2">Address Line 2</label>
                  <input type="text" name="address_line2"
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="Apartment, suite, etc. (optional)">
                </div>

                <div>
                  <label class="block font-fredoka text-blue-500 mb-2">City *</label>
                  <input type="text" name="city" required
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="London">
                </div>

                <div>
                  <label class="block font-fredoka text-blue-500 mb-2">Postcode *</label>
                  <input type="text" name="postal_code" required
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50"
                    placeholder="SW1A 1AA">
                </div>

                <div class="col-span-2">
                  <label class="block font-fredoka text-blue-500 mb-2">Country *</label>
                  <select name="country" required
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50">
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- Payment Info (Dummy) --}}
            <div class="bg-white rounded-3xl p-8 border-4 border-green-600 shadow-xl">
              <h2 class="font-fredoka text-green-600 text-4xl mb-6">
                Payment Details
              </h2>

              <div class="bg-yellow-50 px-6 py-4 rounded-lg border-2 border-dashed border-red-400 mb-6 text-center">
                <p class="m-0 text-gray-600 text-lg">
                  <strong>This is a demo checkout page.</strong><br>
                  No actual payment will be processed.
                </p>
              </div>

              <div class="flex flex-col gap-6">
                <div>
                  <label class="block font-fredoka text-blue-500 mb-2">Card Number *</label>
                  <input type="text" placeholder="1234 5678 9012 3456" maxlength="19"
                    class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50">
                </div>

                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block font-fredoka text-blue-500 mb-2">Expiry *</label>
                    <input type="text" placeholder="MM/YY" maxlength="5"
                      class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50">
                  </div>

                  <div>
                    <label class="block font-fredoka text-blue-500 mb-2">CVV *</label>
                    <input type="text" placeholder="123" maxlength="3"
                      class="w-full px-3 py-2 border-2 border-red-400 rounded-lg font-comic-neue bg-yellow-50">
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Right Column: Order Summary --}}
          <div class="lg:col-span-1">
            <div class="sticky top-8 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-8 text-black shadow-2xl">
              <h2 class="font-fredoka text-4xl mb-6 text-center">
                Order Summary
              </h2>

              <div class="bg-white/20 p-6 rounded-2xl mb-6">
                <div class="flex justify-between mb-4 text-lg">
                  <span>Subtotal:</span>
                  <span class="font-bold">£{{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between mb-4 text-lg">
                  <span>Shipping:</span>
                  <span class="font-bold text-green-700">FREE</span>
                </div>
                <div class="flex justify-between mb-4 text-lg">
                  <span>Tax (VAT 20%):</span>
                  <span class="font-bold">£{{ number_format($total * 0.2, 2) }}</span>
                </div>
                <div class="border-t-2 border-dashed border-black/20 pt-4 mt-4">
                  <div class="flex justify-between text-2xl">
                    <span class="font-fredoka">Total:</span>
                    <span class="font-fredoka text-yellow-700">£{{ number_format($total * 1.2, 2) }}</span>
                  </div>
                </div>
              </div>

              <div class="bg-white/20 p-6 rounded-2xl mb-6 text-center">
                <p class="m-0 mb-2 text-lg"><strong>Estimated Delivery</strong></p>
                <p class="m-0 text-2xl font-fredoka text-yellow-700">
                  3-5 Business Days
                </p>
              </div>

              <button type="submit" class="btn w-full py-4 text-2xl font-fredoka bg-green-600 shadow-lg hover:bg-green-700 hover:scale-105 transition-all">
                Place Order
              </button>

              <p class="text-center mt-4 text-sm opacity-90">
                Secure checkout guaranteed
              </p>
            </div>

            <a href="{{ route('basket.index') }}" class="block text-center mt-4 text-blue-500 no-underline font-comic-neue font-bold hover:text-red-400 transition-colors">
              ← Back to Basket
            </a>
          </div>
        </div>
      </form>
    @endif
  </section>
@endsection