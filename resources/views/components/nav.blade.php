<nav>
  <a href="{{ route('products.index') }}">Home</a>
  <a href="{{ url('/about') }}">About Us</a>
  <a href="{{ route('basket.index') }}" style="position: relative; font-weight: bold;">
    🛒 Basket
    @php
      $cartCount = 0;
      if (Auth::check()) {
        $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
      } else {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
      }
    @endphp
    @if($cartCount > 0)
      <span
        style="position: absolute; top: -8px; right: -10px; background: #ff6f61; color: white; border-radius: 50%; width: 20px; height: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold;">
        {{ $cartCount }}
      </span>
    @endif
  </a>
  <a href="{{ url('/login') }}">Login/Register</a>
  <a href="{{ url('/account') }}">My Account</a>
</nav>