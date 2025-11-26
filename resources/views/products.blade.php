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
      <form method="POST" action="{{ route('basket.add', ['productId' => 5]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 6]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 7]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 8]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 9]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 10]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 11]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 12]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 13]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 14]) }}">
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
      <form method="POST" action="{{ route('basket.add', ['productId' => 15]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <!-- Accessories Girls -->
                       <div class="card" data-category="accessories" data-price="15">
    <img src="{{ asset('images for website/girls accesories 1.png') }}" alt="Pink Backpack" />
    <div class="card-body">
      <h3>Pink Backpack</h3>
      <p>£15.00</p>
      <p>Fun Pink backpack with eyes and rainbows</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 16]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                       <div class="card" data-category="accessories" data-price="10">
    <img src="{{ asset('images for website/girls accesories 2.png') }}" alt="Pink Cap" />
    <div class="card-body">
      <h3>Pink Barbie Cap</h3>
      <p>£10.00</p>
      <p>Pink cap with barbie signature</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 17]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                         <div class="card" data-category="accessories" data-price="15">
    <img src="{{ asset('images for website/girls accesories 3.png') }}" alt="Pink Hat and Mittens" />
    <div class="card-body">
      <h3>Pink Hat and Mittens</h3>
      <p>£15.00</p>
      <p>Pink fluffy hat and mittens set</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 18]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

    <!-- Outerwear Girls -->

                           <div class="card" data-category="outerwear" data-price="26">
    <img src="{{ asset('images for website/girls outerwear 1.png') }}" alt="Fluffy flower fleece" />
    <div class="card-body">
      <h3>Fluffy fleece</h3>
      <p>£26.00</p>
      <p>Fluffy white fleece with flower patterns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 19]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  
                           <div class="card" data-category="outerwear" data-price="24">
    <img src="{{ asset('images for website/girls outerwear 2.png') }}" alt="Fluffy fleece" />
    <div class="card-body">
      <h3>Fluffy fleece</h3>
      <p>£26.00</p>
      <p>Fluffy pink cardigan fleece with crosshatch patterns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 20]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  
                           <div class="card" data-category="outerwear" data-price="20">
    <img src="{{ asset('images for website/girls outerwear 3.png') }}" alt="Denim jacket" />
    <div class="card-body">
      <h3>Denim jacket</h3>
      <p>£20.00</p>
      <p>Denim jacket with heart patterns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 21]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

<!-- Girls Shoes-->
                           <div class="card" data-category="shoes" data-price="20">
    <img src="{{ asset('images for website/girls shoes 1.png') }}" alt="Pink Trainers" />
    <div class="card-body">
      <h3>Pink Trainers</h3>
      <p>£20.00</p>
      <p>Pink trainers with strap</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 22]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                             <div class="card" data-category="shoes" data-price="23">
    <img src="{{ asset('images for website/girls shoes 2.png') }}" alt="Heels" />
    <div class="card-body">
      <h3>Pink Heels</h3>
      <p>£23.00</p>
      <p>Pink heels with bow</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 23]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                               <div class="card" data-category="shoes" data-price="12">
    <img src="{{ asset('images for website/girls shoes 3.png') }}" alt="Pumps" />
    <div class="card-body">
      <h3>Pink Pumps</h3>
      <p>£12.00</p>
      <p>Pink heels with heart pattern</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 24]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>
 <!-- Girls Tops-->
                                 <div class="card" data-category="tops" data-price="18">
    <img src="{{ asset('images for website/girls top 1.png') }}" alt="Jumper" />
    <div class="card-body">
      <h3>Rainbow jumper</h3>
      <p>£18.00</p>
      <p>Rainbow striped jumper with unicorn</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 25]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                                   <div class="card" data-category="tops" data-price="15">
    <img src="{{ asset('images for website/girls top 2.png') }}" alt="T-shirt" />
    <div class="card-body">
      <h3>T-shirt</h3>
      <p>£15.00</p>
      <p>Yellow T-shirt with flowers</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 26]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                                     <div class="card" data-category="tops" data-price="20">
    <img src="{{ asset('images for website/girls top 3.png') }}" alt="Longsleeve shirt" />
    <div class="card-body">
      <h3>Longsleeve shirt</h3>
      <p>£20.00</p>
      <p>Pink longsleeve shirt with buttons</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 27]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

  <!-- Girls Trousers-->

                                        <div class="card" data-category="trousers" data-price="15">
    <img src="{{ asset('images for website/girls bottom 1.png') }}" alt="Skirt" />
    <div class="card-body">
      <h3>Skirt</h3>
      <p>£15.00</p>
      <p>Pink skirt with heart patterns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 28]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                                          <div class="card" data-category="trousers" data-price="15">
    <img src="{{ asset('images for website/girls bottom 2.png') }}" alt="Denim Skirt" />
    <div class="card-body">
      <h3>Denim Skirt</h3>
      <p>£15.00</p>
      <p>Denim skirt with unicorns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 29]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

                                          <div class="card" data-category="trousers" data-price="15">
    <img src="{{ asset('images for website/girls bottom 3.png') }}" alt="Denim Jeans" />
    <div class="card-body">
      <h3>Denim Jeans</h3>
      <p>£20.00</p>
      <p>Denim pink jeans with star patterns</p>
      <p class="stock">In Stock</p>
      <form method="POST" action="{{ route('basket.add', ['productId' => 30]) }}">
        @csrf
        <button class="btn" type="submit">Add to Basket</button>
      </form>
    </div>
  </div>

</section>
@endsection