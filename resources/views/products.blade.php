@extends('layouts.app')

@section('content')
  <header>
    <h1>Brivora Kids Fashion - Product Page</h1>
  </header>

  {{-- Navigation --}}
  <x-nav />

  {{-- Success Message --}}
  @if(session('success'))
    <div
      style="background: #4caf50; color: white; padding: 1rem; margin: 1rem; border-radius: 10px; text-align: center; font-family: 'Comic Neue', cursive; font-size: 1.1rem; animation: slideDown 0.3s ease-out;">
      ✓ {{ session('success') }}
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

  {{-- Filters --}}
  <section class="filters">
    <form method="GET" action="{{ route('products.index') }}">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." />
      <select name="category">
        <option value="">All Categories</option>
        @foreach($categories as $category)
          <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
            {{ $category->name }}
          </option>
        @endforeach
      </select>
      <select name="gender">
        <option value="">All Genders</option>
        @foreach($genders as $gender)
          <option value="{{ $gender->id }}" {{ request('gender') == $gender->id ? 'selected' : '' }}>
            {{ $gender->name }}
          </option>
        @endforeach
      </select>
      <select name="sort">
        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest First</option>
        <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
        <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name: A-Z</option>
      </select>
      <button class="btn" type="submit">Filter</button>
    </form>
  </section>

  {{-- Product Grid --}}
  <section class="products" id="product-list">
    @forelse($products as $product)
      <div class="card" data-category="{{ $product->category->slug ?? '' }}" data-price="{{ $product->price }}">
        {{-- Product Image --}}
        @if($product->images->isNotEmpty())
          <img src="{{ asset($product->images->first()->image_url) }}" alt="{{ $product->name }}" loading="lazy" />
        @elseif($product->image_url)
          <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" loading="lazy" />
        @else
          <img src="{{ asset('images/placeholder.png') }}" alt="{{ $product->name }}" loading="lazy" />
        @endif

        <div class="card-body">
          <h3>{{ $product->name }}</h3>
          <p>{{ $product->formatted_price }}</p>
          <p>{{ Str::limit($product->description, 60) }}</p>

          {{-- Stock Status --}}
          @if($product->stock_quantity > 0)
            @if($product->stock_quantity <= $product->low_stock_threshold)
              <p class="stock low-stock">Low Stock ({{ $product->stock_quantity }} left)</p>
            @else
              <p class="stock">In Stock</p>
            @endif
          @else
            <p class="stock out-of-stock">Out of Stock</p>
          @endif

          {{-- Add to Basket Button --}}
          @if($product->stock_quantity > 0)
            <form method="POST" action="{{ route('basket.add', ['productId' => $product->id]) }}">
              @csrf
              <button class="btn" type="submit">Add to Basket</button>
            </form>
          @else
            <button class="btn" disabled style="opacity: 0.5; cursor: not-allowed;">Out of Stock</button>
          @endif
        </div>
      </div>
    @empty
      <div class="no-products">
        <h2>No products found</h2>
        <p>Try adjusting your filters or search terms.</p>
        <a href="{{ route('products.index') }}" class="btn">Clear Filters</a>
      </div>
    @endforelse
  </section>

  {{-- Bootstrap Pagination --}}
  @if($products->hasPages())
    <div class="d-flex justify-content-center my-4">
      {{ $products->links('pagination::bootstrap-5') }}
    </div>
  @endif


  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    .low-stock {
      color: #ff9800 !important;
      font-weight: bold;
    }

    .out-of-stock {
      color: #f44336 !important;
      font-weight: bold;
    }

    .no-products {
      grid-column: 1 / -1;
      text-align: center;
      padding: 3rem;
      background: #f5f5f5;
      border-radius: 15px;
      margin: 2rem;
    }

    .no-products h2 {
      color: #ff6f61;
      font-family: 'Fredoka One', cursive;
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .no-products p {
      color: #666;
      margin-bottom: 1.5rem;
    }

    /* Custom Bootstrap Pagination Styling */
    .pagination .page-link {
      color: #ff6f61;
      border-color: #ff6f61;
      font-family: 'Comic Neue', cursive;
      transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
      background-color: #ff6f61;
      color: white;
      border-color: #ff6f61;
    }

    .pagination .page-item.active .page-link {
      background-color: #ff6f61;
      border-color: #ff6f61;
      color: white;
    }

    .pagination .page-item.disabled .page-link {
      color: #ccc;
      border-color: #ddd;
    }
  </style>
@endsection