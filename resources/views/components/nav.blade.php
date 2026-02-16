<nav style="display: flex; align-items: center; justify-content: center; flex-wrap: wrap; gap: 2rem;">
  {{-- Logo --}}
  <a href="{{ url('/') }}" style="display: flex; align-items: center; text-decoration: none;">
    <img src="{{ asset('images/brivora-logo.jpeg') }}" alt="Brivora Kids Fashion"
      style="height: 60px; width: auto; border-radius: 8px; transition: transform 0.3s;"
      onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
  </a>

  <div style="display: flex; align-items: center;">
    <a href="{{ route('products.index') }}">Shop</a>
    <a href="{{ route('about') }}">About Us</a>
    <a href="{{ route('basket.index') }}">🛒 Basket</a>

    @auth
      <a href="{{ route('orders.index') }}">📦 My Orders</a>
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