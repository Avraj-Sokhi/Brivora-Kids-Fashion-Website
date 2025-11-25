@extends('layouts.app')

@section('content')
<header>
  <h1>Brivora Kids Fashion - Product Page</h1>
</header>

{{-- Navigation --}}
<x-nav />

{{-- Filters --}}
<section class="filters">
  <form method="GET" action="{{ route('products.index') }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." />
    <select name="category">
      <option value="">All Categories</option>
      <option value="accessories" {{ request('category') === 'accessories' ? 'selected' : '' }}>Accessories</option>
      <option value="outerwear" {{ request('category') === 'outerwear' ? 'selected' : '' }}>Outerwear</option>
      <option value="trousers" {{ request('category') === 'trousers' ? 'selected' : '' }}>Trousers</option>
      <option value="shoes" {{ request('category') === 'shoes' ? 'selected' : '' }}>Shoes</option>
      <option value="tops" {{ request('category') === 'tops' ? 'selected' : '' }}>Tops</option>
    </select>
    <button class="btn" type="submit">Filter</button>
  </form>
</section>

{{-- Product Grid --}}
<section class="products" id="product-list">

  <!-- Accessories Boys -->
  <div class="card" data-category="accessories" data-price="10">
    <img src="{{ asset('images for website/Accessory 1.png') }}" alt="Minecraft Beanie" />
    <div class="card-body">
      <h3>Minecraft Beanie</h3>
      <p>£10.00</p>
      <p>Knitted hat with Creeper patch.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 1]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <div class="card" data-category="accessories" data-price="8">
    <img src="{{ asset('images for website/Accessory 2.png') }}" alt="Fleece Mittens" />
    <div class="card-body">
      <h3>Fleece Mittens</h3>
      <p>£8.00</p>
      <p>Soft navy mittens for winter.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 2]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <div class="card" data-category="accessories" data-price="18">
    <img src="{{ asset('images for website/Accessory 3.png') }}" alt="Kids Backpack" />
    <div class="card-body">
      <h3>Kids Backpack</h3>
      <p>£18.00</p>
      <p>Sporty backpack with patches.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 3]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <!-- Outerwear Boys -->
  <div class="card" data-category="outerwear" data-price="35">
    <img src="{{ asset('images for website/Outerwear 1.png') }}" alt="Rabbit Jacket" />
    <div class="card-body">
      <h3>Rabbit Jacket</h3>
      <p>£35.00</p>
      <p>Quilted navy jacket with rabbit patch.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

    <div class="card" data-category="outerwear" data-price="30">
    <img src="{{ asset('images for website/Outerwear 2.png') }}" alt="Puffer jacket" />
    <div class="card-body">
      <h3>Puffer Jacket</h3>
      <p>£30.00</p>
      <p>Blue puffer with striped cuffs.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

      <div class="card" data-category="outerwear" data-price="28">
    <img src="{{ asset('images for website/Outerwear 3.png') }}" alt="Tractor Fleece" />
    <div class="card-body">
      <h3>Tractor Fleece</h3>
      <p>£28.00</p>
      <p>Fleece coat with tractor print.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

    <!--Shoes Boys-->
        <div class="card" data-category="shoes" data-price="22">
    <img src="{{ asset('images for website/Shoe 1.png') }}" alt="Black high top" />
    <div class="card-body">
      <h3>Black high top</h3>
      <p>£22.00</p>
      <p>Warm sneaker with fuzzy lining .</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

          <div class="card" data-category="shoes" data-price="24">
    <img src="{{ asset('images for website/Shoe 2.png') }}" alt="Marvel Sneaker" />
    <div class="card-body">
  <h3>Marvel Sneaker</h3>
      <p>£24.00</p>
      <p>Superhero-themed high-top sneaker.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

            <div class="card" data-category="shoes" data-price="26">
    <img src="{{ asset('images for website/Shoe 3.png') }}" alt="Jurassic Sneaker" />
    <div class="card-body">
      <h3>Jurassic Sneaker</h3>
      <p>£26.00</p>
      <p>Dinosaur-themed canvas sneaker.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

    <!-- Tops Boys -->
                 <div class="card" data-category="tops" data-price="16">
    <img src="{{ asset('images for website/Top 1.png') }}" alt="Navy Polo Shirt" />
    <div class="card-body">
      <h3>Navy Polo Shirt</h3>
      <p>£16.00</p>
      <p>Classic polo with white collar.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                   <div class="card" data-category="tops" data-price="14">
    <img src="{{ asset('images for website/Top 2.png') }}" alt="Racecar Shirt" />
    <div class="card-body">
      <h3>Racecar Shirt</h3>
      <p>£14.00</p>
      <p>Striped shirt with embroidered racecars.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                     <div class="card" data-category="tops" data-price="15">
    <img src="{{ asset('images for website/Top 3.png') }}" alt="Dinosaur Shirt" />
    <div class="card-body">
      <h3>Dinosaur Shirt</h3>
      <p>£15.00</p>
      <p>Fun dino-themed long sleeve shirt.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <!-- Trousers Boys -->
                       <div class="card" data-category="trousers" data-price="18">
    <img src="{{ asset('images for website/Trousers 1.png') }}" alt="Planet Joggers" />
    <div class="card-body">
      <h3>Planet Joggers</h3>
      <p>£18.00</p>
      <p>Space-themed joggers with planet embroidery.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                       <div class="card" data-category="trousers" data-price="17">
    <img src="{{ asset('images for website/Trousers 2.png') }}" alt="Dino Joggers" />
    <div class="card-body">
      <h3>Dino Joggers</h3>
      <p>£17.00</p>
      <p>Elastic joggers with pastel dinosaur print.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  
                       <div class="card" data-category="trousers" data-price="20">
    <img src="{{ asset('images for website/Trousers 3.png') }}" alt="Pokémon Joggers" />
    <div class="card-body">
      <h3>Pokémon Joggers</h3>
      <p>£20.00</p>
      <p>Black joggers with Pikachu and other pokemons.</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 4]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>


  <!-- GIRLS SECTION -->
  {{-- NOTE FOR TEAMMATES:
       Please add girls' products below using the same structure.
       Use categories: accessories, outerwear, trousers, shoes, tops.
       Each product block should include:
       - <div class="card" data-category="CATEGORY" data-price="PRICE">
       - <img src="{{ asset('images for website/FILENAME') }}" alt="ALT TEXT" />
       - Product name, price, description, stock status, and Add to Basket button.
  --}}
</section>
@endsection