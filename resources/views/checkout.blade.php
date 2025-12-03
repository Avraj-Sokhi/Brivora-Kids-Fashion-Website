@extends('layouts.app')

@section('content')
  <header>
    <h1>Checkout</h1>
  </header>

  {{-- Navigation --}}
  <x-nav />

  <section style="max-width: 1400px; margin: 2rem auto; padding: 2rem;">
    @if($cartItems->isEmpty())
      {{-- Empty Basket State --}}
      <div
        style="text-align: center; padding: 3rem; background: #f0f9ff; border-radius: 20px; border: 3px dashed #4a90e2; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <div style="font-size: 5rem; margin-bottom: 1rem;">🛒</div>
        <h2 style="color: #ff6f61; font-family: 'Fredoka One', cursive; font-size: 2rem; margin-bottom: 1rem;">
          Your basket is empty!
        </h2>
        <p style="margin: 1rem 0; font-size: 1.2rem; color: #666;">
          Add some awesome products before checking out.
        </p>
        <a href="{{ route('products.index') }}" class="btn"
          style="display: inline-block; margin-top: 1rem; text-decoration: none; font-size: 1.1rem; padding: 0.8rem 2rem;">
          Browse Products
        </a>
      </div>
    @else
      <form method="POST" action="{{ route('checkout.process') }}">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">

          {{-- Left Column: Order Items & Customer Info --}}
          <div style="display: flex; flex-direction: column; gap: 2rem;">

            {{-- Order Items --}}
            <div
              style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #4a90e2; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
              <h2 style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 2rem; margin-bottom: 1.5rem;">
                Your Order ({{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'items' }})
              </h2>

              <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($cartItems as $item)
                  <div
                    style="display: flex; align-items: center; gap: 1.5rem; padding: 1rem; background: #f0f9ff; border-radius: 15px; border: 2px solid #e0e0e0;">
                    {{-- Product Image --}}
                    @if($item->product->images->isNotEmpty())
                      <img src="{{ asset($item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}"
                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; flex-shrink: 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    @else
                      <div
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6f61 0%, #ff4081 100%); border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                        👕
                      </div>
                    @endif

                    <div style="flex: 1;">
                      <h4 style="margin: 0 0 0.5rem; font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 1.2rem;">
                        {{ $item->product->name }}
                      </h4>
                      <p style="margin: 0; color: #666; font-size: 0.95rem;">
                        Quantity: <strong>{{ $item->quantity }}</strong>
                      </p>
                      <p style="margin: 0.3rem 0 0; color: #4a90e2; font-weight: bold;">
                        £{{ number_format($item->product->price, 2) }} each
                      </p>
                    </div>

                    <div style="text-align: right;">
                      <p style="margin: 0; color: #4caf50; font-family: 'Fredoka One', cursive; font-size: 1.5rem;">
                        £{{ number_format($item->total, 2) }}
                      </p>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Delivery Information --}}
            <div
              style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #ff6f61; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
              <h2 style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2rem; margin-bottom: 1.5rem;">
                Delivery Information
              </h2>

              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div style="grid-column: 1 / -1;">
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Full
                    Name *</label>
                  <input type="text" name="name" required value="{{ Auth::check() ? Auth::user()->name : '' }}"
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="John Doe">
                </div>

                <div>
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Email
                    *</label>
                  <input type="email" name="email" required value="{{ Auth::check() ? Auth::user()->email : '' }}"
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="john@example.com">
                </div>

                <div>
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Phone
                    *</label>
                  <input type="tel" name="phone" required
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="+44 123 456 7890">
                </div>

                <div style="grid-column: 1 / -1;">
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Address
                    Line 1 *</label>
                  <input type="text" name="address_line1" required
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="123 Main Street">
                </div>

                <div style="grid-column: 1 / -1;">
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Address
                    Line 2</label>
                  <input type="text" name="address_line2"
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="Apartment, suite, etc. (optional)">
                </div>

                <div>
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">City
                    *</label>
                  <input type="text" name="city" required
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="London">
                </div>

                <div>
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Postcode
                    *</label>
                  <input type="text" name="postal_code" required
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                    placeholder="SW1A 1AA">
                </div>

                <div style="grid-column: 1 / -1;">
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Country
                    *</label>
                  <select name="country" required
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="Australia">Australia</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- Payment Info (Dummy) --}}
            <div
              style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #4caf50; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
              <h2 style="font-family: 'Fredoka One', cursive; color: #4caf50; font-size: 2rem; margin-bottom: 1.5rem;">
                Payment Details
              </h2>

              <div
                style="background: #fff8e1; padding: 1.5rem; border-radius: 10px; border: 2px dashed #ff6f61; margin-bottom: 1.5rem; text-align: center;">
                <p style="margin: 0; color: #666; font-size: 1.1rem;">
                  <strong>This is a demo checkout page.</strong><br>
                  No actual payment will be processed.
                </p>
              </div>

              <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                  <label
                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Card
                    Number *</label>
                  <input type="text" placeholder="1234 5678 9012 3456" maxlength="19"
                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                  <div>
                    <label
                      style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Expiry
                      *</label>
                    <input type="text" placeholder="MM/YY" maxlength="5"
                      style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                  </div>

                  <div>
                    <label
                      style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">CVV
                      *</label>
                    <input type="text" placeholder="123" maxlength="3"
                      style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Right Column: Order Summary --}}
          <div style="position: sticky; top: 2rem; height: fit-content;">
            <div
              style="background: linear-gradient(135deg, #4a90e2 0%, #1477b5 100%); border-radius: 20px; padding: 2rem; color: white; box-shadow: 0 8px 16px rgba(0,0,0,0.2);">
              <h2 style="font-family: 'Fredoka One', cursive; font-size: 2rem; margin-bottom: 1.5rem; text-align: center;">
                Order Summary
              </h2>

              <div style="background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem;">
                  <span>Subtotal:</span>
                  <span style="font-weight: bold;">£{{ number_format($total, 2) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem;">
                  <span>Shipping:</span>
                  <span style="font-weight: bold; color: #4caf50;">FREE</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem;">
                  <span>Tax (VAT 20%):</span>
                  <span style="font-weight: bold;">£{{ number_format($total * 0.2, 2) }}</span>
                </div>
                <div style="border-top: 2px dashed rgba(255,255,255,0.5); padding-top: 1rem; margin-top: 1rem;">
                  <div style="display: flex; justify-content: space-between; font-size: 1.5rem;">
                    <span style="font-family: 'Fredoka One', cursive;">Total:</span>
                    <span
                      style="font-family: 'Fredoka One', cursive; color: #ffeb3b;">£{{ number_format($total * 1.2, 2) }}</span>
                  </div>
                </div>
              </div>

              <div
                style="background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem; text-align: center;">
                <p style="margin: 0 0 0.5rem; font-size: 1.1rem;"><strong>Estimated Delivery</strong></p>
                <p style="margin: 0; font-size: 1.3rem; font-family: 'Fredoka One', cursive; color: #ffeb3b;">
                  3-5 Business Days
                </p>
              </div>

              <button type="submit" class="btn"
                style="width: 100%; padding: 1.2rem; font-size: 1.3rem; font-family: 'Fredoka One', cursive; background: #4caf50; border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.3); transition: all 0.3s;"
                onmouseover="this.style.transform='scale(1.05)'; this.style.background='#45a049'"
                onmouseout="this.style.transform='scale(1)'; this.style.background='#4caf50'">
                Place Order
              </button>

              <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; opacity: 0.9;">
                Secure checkout guaranteed
              </p>
            </div>

            <a href="{{ route('basket.index') }}"
              style="display: block; text-align: center; margin-top: 1rem; color: #4a90e2; text-decoration: none; font-family: 'Comic Neue', cursive; font-weight: bold; transition: color 0.3s;"
              onmouseover="this.style.color='#ff6f61'" onmouseout="this.style.color='#4a90e2'">
              ← Back to Basket
            </a>
          </div>
        </div>
      </form>
    @endif
  </section>

  <style>
    @media (max-width: 1024px) {
      section>form>div {
        grid-template-columns: 1fr !important;
      }

      section>form>div>div:last-child {
        position: static !important;
      }
    }
  </style>
@endsection