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
            <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2rem;">

                {{-- Left Column: Order Items & Customer Info --}}
                <div style="display: flex; flex-direction: column; gap: 2rem;">

                    {{-- Order Items --}}
                    <div
                        style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #4a90e2; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                        <h2
                            style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 2rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            🛍️ Your Order ({{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'items' }})
                        </h2>

                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($cartItems as $item)
                                <div
                                    style="display: flex; align-items: center; gap: 1.5rem; padding: 1rem; background: #f0f9ff; border-radius: 15px; border: 2px solid #e0e0e0;">
                                    {{-- Product Image Placeholder --}}
                                    <div
                                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6f61 0%, #ff4081 100%); border-radius: 10px; flex-shrink: 0; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                                        👕
                                    </div>

                                    {{-- Product Details --}}
                                    <div style="flex: 1;">
                                        <h4
                                            style="margin: 0 0 0.5rem; font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 1.2rem;">
                                            {{ $item->product->name }}
                                        </h4>
                                        <p style="margin: 0; color: #666; font-size: 0.95rem;">
                                            Quantity: <strong>{{ $item->quantity }}</strong>
                                        </p>
                                        <p style="margin: 0.3rem 0 0; color: #4a90e2; font-weight: bold;">
                                            £{{ number_format($item->product->price, 2) }} each
                                        </p>
                                    </div>

                                    {{-- Item Total --}}
                                    <div style="text-align: right;">
                                        <p
                                            style="margin: 0; color: #4caf50; font-family: 'Fredoka One', cursive; font-size: 1.5rem;">
                                            £{{ number_format($item->total, 2) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Customer Information Form --}}
                    <div
                        style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #ff6f61; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                        <h2
                            style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            📝 Delivery Information
                        </h2>

                        <form id="checkoutForm" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            {{-- Full Name --}}
                            <div style="grid-column: 1 / -1;">
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Full Name *
                                </label>
                                <input type="text" required value="{{ Auth::check() ? Auth::user()->name : '' }}"
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="John Doe">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Email *
                                </label>
                                <input type="email" required value="{{ Auth::check() ? Auth::user()->email : '' }}"
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="john@example.com">
                            </div>

                            {{-- Phone --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Phone *
                                </label>
                                <input type="tel" required
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="+44 123 456 7890">
                            </div>

                            {{-- Address Line 1 --}}
                            <div style="grid-column: 1 / -1;">
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Address Line 1 *
                                </label>
                                <input type="text" required
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="123 Main Street">
                            </div>

                            {{-- Address Line 2 --}}
                            <div style="grid-column: 1 / -1;">
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Address Line 2
                                </label>
                                <input type="text"
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="Apartment, suite, etc. (optional)">
                            </div>

                            {{-- City --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    City *
                                </label>
                                <input type="text" required
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="London">
                            </div>

                            {{-- Postcode --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Postcode *
                                </label>
                                <input type="text" required
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;"
                                    placeholder="SW1A 1AA">
                            </div>

                            {{-- Country --}}
                            <div style="grid-column: 1 / -1;">
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Country *
                                </label>
                                <select required
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                                    <option value="UK">United Kingdom</option>
                                    <option value="US">United States</option>
                                    <option value="CA">Canada</option>
                                    <option value="AU">Australia</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    {{-- Payment Information (Dummy) --}}
                    <div
                        style="background: white; border-radius: 20px; padding: 2rem; border: 3px solid #4caf50; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
                        <h2
                            style="font-family: 'Fredoka One', cursive; color: #4caf50; font-size: 2rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                            💳 Payment Details
                        </h2>

                        <div
                            style="background: #fff8e1; padding: 1.5rem; border-radius: 10px; border: 2px dashed #ff6f61; margin-bottom: 1.5rem; text-align: center;">
                            <p style="margin: 0; color: #666; font-size: 1.1rem;">
                                🔒 <strong>This is a demo checkout page.</strong><br>
                                No actual payment will be processed.
                            </p>
                        </div>

                        <form style="display: flex; flex-direction: column; gap: 1.5rem;">
                            {{-- Card Number --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Card Number *
                                </label>
                                <input type="text" placeholder="1234 5678 9012 3456" maxlength="19"
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                            </div>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                {{-- Expiry Date --}}
                                <div>
                                    <label
                                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                        Expiry Date *
                                    </label>
                                    <input type="text" placeholder="MM/YY" maxlength="5"
                                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                                </div>

                                {{-- CVV --}}
                                <div>
                                    <label
                                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                        CVV *
                                    </label>
                                    <input type="text" placeholder="123" maxlength="3"
                                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                                </div>
                            </div>

                            {{-- Cardholder Name --}}
                            <div>
                                <label
                                    style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">
                                    Cardholder Name *
                                </label>
                                <input type="text" placeholder="John Doe"
                                    style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; background-color: #fff8e1;">
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Right Column: Order Summary --}}
                <div style="position: sticky; top: 2rem; height: fit-content;">
                    <div
                        style="background: linear-gradient(135deg, #4a90e2 0%, #1477b5 100%); border-radius: 20px; padding: 2rem; color: white; box-shadow: 0 8px 16px rgba(0,0,0,0.2);">
                        <h2
                            style="font-family: 'Fredoka One', cursive; font-size: 2rem; margin-bottom: 1.5rem; text-align: center;">
                            📊 Order Summary
                        </h2>

                        {{-- Price Breakdown --}}
                        <div
                            style="background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem;">
                                <span>Subtotal:</span>
                                <span style="font-weight: bold;">£{{ number_format($total, 2) }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 1.1rem;">
                                <span>Shipping:</span>
                                <span style="font-weight: bold; color: #4caf50;">FREE 🎉</span>
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

                        {{-- Delivery Info --}}
                        <div
                            style="background: rgba(255,255,255,0.2); padding: 1.5rem; border-radius: 15px; margin-bottom: 1.5rem; text-align: center;">
                            <p style="margin: 0 0 0.5rem; font-size: 1.1rem;">🚚 <strong>Estimated Delivery</strong></p>
                            <p style="margin: 0; font-size: 1.3rem; font-family: 'Fredoka One', cursive; color: #ffeb3b;">
                                3-5 Business Days
                            </p>
                        </div>

                        {{-- Place Order Button --}}
                        <button onclick="placeOrder()" class="btn"
                            style="width: 100%; padding: 1.2rem; font-size: 1.3rem; font-family: 'Fredoka One', cursive; background: #4caf50; border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.3); transition: all 0.3s;"
                            onmouseover="this.style.transform='scale(1.05)'; this.style.background='#45a049'"
                            onmouseout="this.style.transform='scale(1)'; this.style.background='#4caf50'">
                            Place Order 🎉
                        </button>

                        <p style="text-align: center; margin-top: 1rem; font-size: 0.9rem; opacity: 0.9;">
                            🔒 Secure checkout guaranteed
                        </p>
                    </div>

                    {{-- Back to Basket --}}
                    <a href="{{ route('basket.index') }}"
                        style="display: block; text-align: center; margin-top: 1rem; color: #4a90e2; text-decoration: none; font-family: 'Comic Neue', cursive; font-weight: bold; transition: color 0.3s;"
                        onmouseover="this.style.color='#ff6f61'" onmouseout="this.style.color='#4a90e2'">
                        ← Back to Basket
                    </a>
                </div>
            </div>
        @endif
    </section>

    {{-- Order Confirmation Modal --}}
    <div id="confirmationModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 9999; align-items: center; justify-content: center;">
        <div
            style="background: white; padding: 3rem; border-radius: 30px; max-width: 500px; text-align: center; animation: slideIn 0.5s ease-out; box-shadow: 0 16px 32px rgba(0,0,0,0.3);">
            <div style="font-size: 5rem; margin-bottom: 1rem;">🎉</div>
            <h2 style="font-family: 'Fredoka One', cursive; color: #4caf50; font-size: 2.5rem; margin-bottom: 1rem;">
                Order Placed!
            </h2>
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 1rem;">
                Thank you for your order!
            </p>
            <p style="font-size: 1rem; color: #999; margin-bottom: 2rem;">
                Order #<span id="orderNumber"></span>
            </p>
            <p style="background: #fff8e1; padding: 1rem; border-radius: 10px; margin-bottom: 2rem; color: #666;">
                <strong>Note:</strong> This is a demo. No actual order was placed.
            </p>
            <a href="{{ route('products.index') }}" class="btn"
                style="display: inline-block; text-decoration: none; padding: 1rem 2rem; font-size: 1.2rem;">
                Continue Shopping
            </a>
        </div>
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (max-width: 1024px) {
            section>div {
                grid-template-columns: 1fr !important;
            }

            section>div>div:last-child {
                position: static !important;
            }
        }
    </style>

    <script>
        function placeOrder() {
            // Generate random order number
            const orderNumber = 'BRV' + Math.floor(Math.random() * 1000000);
            document.getElementById('orderNumber').textContent = orderNumber;

            // Show confirmation modal
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'flex';

            // Optional: Clear basket after 2 seconds and redirect
            setTimeout(() => {
                // In a real application, you would clear the basket here
                // window.location.href = '{{ route("products.index") }}';
            }, 5000);
        }

        // Close modal when clicking outside
        document.getElementById('confirmationModal')?.addEventListener('click', function (e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
@endsection