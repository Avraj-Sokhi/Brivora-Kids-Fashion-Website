<nav style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
  {{-- Logo --}}
  <a href="{{ url('/') }}" style="display: flex; align-items: center; margin-right: 2rem; text-decoration: none;">
    <img src="{{ asset('images/brivora-logo.jpeg') }}" alt="Brivora Kids Fashion"
      style="height: 60px; width: auto; border-radius: 8px; transition: transform 0.3s;"
      onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
  </a>

  {{-- Navigation Links --}}
  <div style="display: flex; align-items: center; gap: 0; flex-wrap: wrap; flex: 1;">
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('about') }}">About Us</a>
    <a href="{{ route('contact.index') }}">Contact Us</a>
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

    @auth
      <a href="{{ route('profile.edit') }}">Profile</a>
      <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit"
          style="background: none; border: none; color: #fff; margin: 0 1rem; font-weight: bold; font-family: 'Comic Neue', cursive; cursor: pointer; transition: color 0.3s;"
          onmouseover="this.style.color='#ffeb3b'; this.style.textDecoration='underline'"
          onmouseout="this.style.color='#fff'; this.style.textDecoration='none'">
          Logout
        </button>
      </form>
    @else
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
    @endauth
  </div>
</nav>