<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 200),
            'stock' => $this->faker->numberBetween(0, 50),
            'is_active' => true,
        ];
    }
}
