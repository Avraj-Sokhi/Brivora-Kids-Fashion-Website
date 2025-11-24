<?php

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('product relationship methods declare correct relation return types', function () {
    $reflect = new ReflectionClass(Product::class);

    $map = [
        'category' => BelongsTo::class,
        'ageGroup' => BelongsTo::class,
        'sizes' => BelongsToMany::class,
        'images' => HasMany::class,
        'cartItems' => HasMany::class,
        'orderItems' => HasMany::class,
        'reviews' => HasMany::class,
    ];

    foreach ($map as $method => $expected) {
        expect($reflect->hasMethod($method))->toBeTrue();
        $rm = $reflect->getMethod($method);
        $rt = $rm->getReturnType();
        expect($rt)->not->toBeNull();
        expect($rt->getName())->toBe($expected);
    }
});

test('formatted price accessor returns currency string', function () {
    $product = new Product(['price' => 12.5]);

    expect($product->formatted_price)->toBe('$12.50');
});

test('scopes exist on the model', function () {
    $reflect = new ReflectionClass(Product::class);

    expect($reflect->hasMethod('scopeActive'))->toBeTrue();
    expect($reflect->hasMethod('scopeLowStock'))->toBeTrue();
});
