<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Accessories Boys
            [
                'name' => 'Minecraft Beanie',
                'description' => 'Knitted hat with Creeper patch.',
                'price' => 10.00,
                'category_id' => 1,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Fleece Mittens',
                'description' => 'Soft navy mittens for winter.',
                'price' => 8.00,
                'category_id' => 1,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Kids Backpack',
                'description' => 'Sporty backpack with patches.',
                'price' => 18.00,
                'category_id' => 1,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Outerwear Boys
            [
                'name' => 'Rabbit Jacket',
                'description' => 'Quilted navy jacket with rabbit patch.',
                'price' => 35.00,
                'category_id' => 2,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Puffer Jacket',
                'description' => 'Blue puffer with striped cuffs.',
                'price' => 30.00,
                'category_id' => 2,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Tractor Fleece',
                'description' => 'Fleece coat with tractor print.',
                'price' => 28.00,
                'category_id' => 2,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Shoes Boys
            [
                'name' => 'Black high top',
                'description' => 'Warm sneaker with fuzzy lining.',
                'price' => 22.00,
                'category_id' => 3,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Marvel Sneaker',
                'description' => 'Superhero-themed high-top sneaker.',
                'price' => 24.00,
                'category_id' => 3,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Jurassic Sneaker',
                'description' => 'Dinosaur-themed canvas sneaker.',
                'price' => 26.00,
                'category_id' => 3,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Tops Boys
            [
                'name' => 'Navy Polo Shirt',
                'description' => 'Classic polo with white collar.',
                'price' => 16.00,
                'category_id' => 4,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Racecar Shirt',
                'description' => 'Striped shirt with embroidered racecars.',
                'price' => 14.00,
                'category_id' => 4,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Dinosaur Shirt',
                'description' => 'Fun dino-themed long sleeve shirt.',
                'price' => 15.00,
                'category_id' => 4,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Trousers Boys
            [
                'name' => 'Planet Joggers',
                'description' => 'Space-themed joggers with planet embroidery.',
                'price' => 18.00,
                'category_id' => 5,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Dino Joggers',
                'description' => 'Elastic joggers with pastel dinosaur print.',
                'price' => 17.00,
                'category_id' => 5,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pokémon Joggers',
                'description' => 'Black joggers with Pikachu and other pokemons.',
                'price' => 20.00,
                'category_id' => 5,
                'age_group_id' => 1,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Accessories Girls
            [
                'name' => 'Pink Backpack',
                'description' => 'Fun Pink backpack with eyes and rainbows',
                'price' => 15.00,
                'category_id' => 1,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Barbie Cap',
                'description' => 'Pink cap with barbie signature',
                'price' => 10.00,
                'category_id' => 1,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Hat and Mittens',
                'description' => 'Pink fluffy hat and mittens set',
                'price' => 15.00,
                'category_id' => 1,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Outerwear Girls
            [
                'name' => 'Fluffy fleece',
                'description' => 'Fluffy white fleece with flower patterns',
                'price' => 26.00,
                'category_id' => 2,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Fluffy Cardigan',
                'description' => 'Fluffy pink cardigan fleece with crosshatch patterns',
                'price' => 24.00,
                'category_id' => 2,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Denim jacket',
                'description' => 'Denim jacket with heart patterns',
                'price' => 20.00,
                'category_id' => 2,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Girls Shoes
            [
                'name' => 'Pink Trainers',
                'description' => 'Pink trainers with strap',
                'price' => 20.00,
                'category_id' => 3,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Heels',
                'description' => 'Pink heels with bow',
                'price' => 23.00,
                'category_id' => 3,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Pumps',
                'description' => 'Pink heels with heart pattern',
                'price' => 12.00,
                'category_id' => 3,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Girls Tops
            [
                'name' => 'Rainbow jumper',
                'description' => 'Rainbow striped jumper with unicorn',
                'price' => 18.00,
                'category_id' => 4,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Yellow T-shirt',
                'description' => 'Yellow T-shirt with flowers',
                'price' => 15.00,
                'category_id' => 4,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Pink Longsleeve shirt',
                'description' => 'Pink longsleeve shirt with buttons',
                'price' => 20.00,
                'category_id' => 4,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            // Girls Trousers
            [
                'name' => 'Pink Skirt',
                'description' => 'Pink skirt with heart patterns',
                'price' => 15.00,
                'category_id' => 5,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Denim Skirt',
                'description' => 'Denim skirt with unicorns',
                'price' => 15.00,
                'category_id' => 5,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
            [
                'name' => 'Denim Jeans',
                'description' => 'Denim pink jeans with star patterns',
                'price' => 20.00,
                'category_id' => 5,
                'age_group_id' => 2,
                'stock_quantity' => 50,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
