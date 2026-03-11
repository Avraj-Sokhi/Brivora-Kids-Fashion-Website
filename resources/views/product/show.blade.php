@extends('layouts.app')

@section('content')

<h1>{{ $product->name }}</h1>

<p>£{{ number_format($product->price, 2) }}</p>

<p>{{ $product->description }}</p>


<h4>Leave a Review</h4>

<form method="POST" action="{{ route('reviews.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <select name="rating" required>
        @for($i=1; $i<=5; $i++)
            <option value="{{ $i }}">{{ $i }} Stars</option>
        @endfor
    </select>

    <textarea name="comment" placeholder="Write review..."></textarea>

    <button class="btn btn-primary">Submit Review</button>
</form>
@endsection