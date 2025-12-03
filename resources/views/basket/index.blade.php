@extends('layouts.app')

@section('content')
    <header>
        <h1>Your Shopping Basket</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    {{-- Success Message --}}
    @if(session('success'))
        <div style="background: #4caf50; color: white; padding: 1rem; margin: 1rem; border-radius: 10px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Basket Content --}}
    <section style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
        @if($cartItems->isEmpty())
            <div
                style="text-align: center; padding: 3rem; background: #f0f9ff; border-radius: 15px; border: 3px dashed #4a90e2;">
                <h2 style="color: #ff6f61; font-family: 'Fredoka One', cursive; font-size: 2rem;">Your basket is empty!</h2>
                <p style="margin: 1rem 0; font-size: 1.2rem;">Add some awesome products to get started.</p>
                <a href="{{ route('products.index') }}" class="btn"
                    style="display: inline-block; margin-top: 1rem; text-decoration: none;">
                    Continue Shopping
                </a>
            </div>
        @else
            <div
                style="background: white; border-radius: 15px; padding: 2rem; border: 3px solid #4a90e2; box-shadow: 0 4px 8px rgba(0,0,0,0.15);">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #4a90e2; color: white;">
                            <th style="padding: 1rem; text-align: left; font-family: 'Fredoka One', cursive;">Product</th>
                            <th style="padding: 1rem; text-align: center; font-family: 'Fredoka One', cursive;">Price</th>
                            <th style="padding: 1rem; text-align: center; font-family: 'Fredoka One', cursive;">Quantity</th>
                            <th style="padding: 1rem; text-align: center; font-family: 'Fredoka One', cursive;">Total</th>
                            <th style="padding: 1rem; text-align: center; font-family: 'Fredoka One', cursive;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr style="border-bottom: 2px solid #e0e0e0;">
                                <td style="padding: 1rem;">
                                    <strong style="color: #ff6f61; font-size: 1.1rem;">{{ $item->product->name }}</strong>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    £{{ number_format($item->product->price, 2) }}
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <form method="POST" action="{{ route('basket.update', $item->product_id) }}"
                                        style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="99"
                                            style="width: 60px; padding: 0.5rem; border: 2px solid #ff6f61; border-radius: 10px; text-align: center; font-family: 'Comic Neue', cursive;">
                                        <button type="submit" class="btn"
                                            style="padding: 0.3rem 0.8rem; font-size: 0.9rem;">Update</button>
                                    </form>
                                </td>
                                <td
                                    style="padding: 1rem; text-align: center; font-weight: bold; color: #4caf50; font-size: 1.1rem;">
                                    £{{ number_format(Auth::check() ? $item->total : $item->total, 2) }}
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <form method="POST" action="{{ route('basket.remove', $item->product_id) }}"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="background: #e74c3c; padding: 0.5rem 1rem;"
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
                <div
                    style="margin-top: 2rem; padding: 1.5rem; background: #fff8e1; border-radius: 10px; border: 2px solid #ff6f61;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <h3 style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 1.5rem;">Basket Total:</h3>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #4caf50; font-size: 2rem;">
                            £{{ number_format($total, 2) }}</h3>
                    </div>

                    <div style="display: flex; gap: 1rem; justify-content: flex-end; flex-wrap: wrap;">
                        <form method="POST" action="{{ route('basket.clear') }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #e74c3c;"
                                onclick="return confirm('Clear entire basket?')">
                                Clear Basket
                            </button>
                        </form>

                        <a href="{{ route('products.index') }}" class="btn"
                            style="background: #4a90e2; text-decoration: none; display: inline-block;">
                            Continue Shopping
                        </a>

                        <a href="{{ route('checkout.index') }}" class="btn"
                            style="background: #4caf50; text-decoration: none; display: inline-block; font-size: 1.1rem; padding: 0.7rem 1.5rem;">
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