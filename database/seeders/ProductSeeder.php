<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Gender;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories if they don't exist
        $categories = [
            'Accessories' => Category::firstOrCreate(['name' => 'Accessories', 'slug' => 'accessories']),
            'Outerwear' => Category::firstOrCreate(['name' => 'Outerwear', 'slug' => 'outerwear']),
            'Shoes' => Category::firstOrCreate(['name' => 'Shoes', 'slug' => 'shoes']),
            'Tops' => Category::firstOrCreate(['name' => 'Tops', 'slug' => 'tops']),
            'Trousers' => Category::firstOrCreate(['name' => 'Trousers', 'slug' => 'trousers']),
        ];

        // Create genders if they don't exist
        $genders = [
            'Boys' => Gender::firstOrCreate(['name' => 'Boys']),
            'Girls' => Gender::firstOrCreate(['name' => 'Girls']),
        ];

       $products = [
    // Boys Accessories
['name' => 'Minecraft Beanie', 'price' => 10.00, 'category' => 'Accessories', 'gender' => 'Boys', 'description' => 'Warm knitted beanie with Creeper patch.'],
['name' => 'Fleece Mittens', 'price' => 8.00, 'category' => 'Accessories', 'gender' => 'Boys', 'description' => 'Soft fleece mittens for cold weather.'],
['name' => 'Kids Backpack', 'price' => 18.00, 'category' => 'Accessories', 'gender' => 'Boys', 'description' => 'Sporty backpack with colourful patches.'],

// Boys Outerwear
['name' => 'Rabbit Jacket', 'price' => 35.00, 'category' => 'Outerwear', 'gender' => 'Boys', 'description' => 'Quilted jacket with rabbit patch detail.'],
['name' => 'Puffer Jacket', 'price' => 30.00, 'category' => 'Outerwear', 'gender' => 'Boys', 'description' => 'Warm blue puffer jacket for winter.'],
['name' => 'Tractor Fleece', 'price' => 28.00, 'category' => 'Outerwear', 'gender' => 'Boys', 'description' => 'Cosy fleece coat with tractor print.'],

// Boys Shoes
['name' => 'Black High Top', 'price' => 22.00, 'category' => 'Shoes', 'gender' => 'Boys', 'description' => 'Black high-top sneakers with soft lining.'],
['name' => 'Marvel Sneaker', 'price' => 24.00, 'category' => 'Shoes', 'gender' => 'Boys', 'description' => 'Marvel superhero-themed high-top sneakers.'],
['name' => 'Jurassic Sneaker', 'price' => 26.00, 'category' => 'Shoes', 'gender' => 'Boys', 'description' => 'Dinosaur-themed canvas sneakers for kids.'],

// Boys Tops
['name' => 'Navy Polo Shirt', 'price' => 16.00, 'category' => 'Tops', 'gender' => 'Boys', 'description' => 'Classic navy polo with white collar.'],
['name' => 'Racecar Shirt', 'price' => 14.00, 'category' => 'Tops', 'gender' => 'Boys', 'description' => 'Striped shirt with embroidered racecars.'],
['name' => 'Dinosaur Shirt', 'price' => 15.00, 'category' => 'Tops', 'gender' => 'Boys', 'description' => 'Fun dinosaur-themed long-sleeve shirt.'],

// Boys Trousers
['name' => 'Planet Joggers', 'price' => 18.00, 'category' => 'Trousers', 'gender' => 'Boys', 'description' => 'Space-themed joggers with planet embroidery.'],
['name' => 'Dino Joggers', 'price' => 17.00, 'category' => 'Trousers', 'gender' => 'Boys', 'description' => 'Joggers with colourful dinosaur print.'],
['name' => 'Pokémon Joggers', 'price' => 20.00, 'category' => 'Trousers', 'gender' => 'Boys', 'description' => 'Black joggers with Pokémon design.'],

// Girls Accessories
['name' => 'Pink Backpack', 'price' => 15.00, 'category' => 'Accessories', 'gender' => 'Girls', 'description' => 'Pink backpack with rainbow details.'],
['name' => 'Pink Barbie Cap', 'price' => 10.00, 'category' => 'Accessories', 'gender' => 'Girls', 'description' => 'Pink cap with Barbie-style logo.'],
['name' => 'Pink Hat and Mittens', 'price' => 15.00, 'category' => 'Accessories', 'gender' => 'Girls', 'description' => 'Soft pink hat and mittens set.'],

// Girls Outerwear
['name' => 'Fluffy Fleece', 'price' => 26.00, 'category' => 'Outerwear', 'gender' => 'Girls', 'description' => 'Fluffy pink and white fleece jacket.'],
['name' => 'Pink Cardigan Fleece', 'price' => 24.00, 'category' => 'Outerwear', 'gender' => 'Girls', 'description' => 'Soft pink cardigan-style fleece jacket.'],
['name' => 'Denim Jacket', 'price' => 20.00, 'category' => 'Outerwear', 'gender' => 'Girls', 'description' => 'Denim jacket with colourful hearts.'],

// Girls Shoes
['name' => 'Pink Trainers', 'price' => 20.00, 'category' => 'Shoes', 'gender' => 'Girls', 'description' => 'Pink trainers with easy strap fastening.'],
['name' => 'Pink Heels', 'price' => 23.00, 'category' => 'Shoes', 'gender' => 'Girls', 'description' => 'Pink party heels with bow detail.'],
['name' => 'Pink Pumps', 'price' => 12.00, 'category' => 'Shoes', 'gender' => 'Girls', 'description' => 'Pink pumps with heart pattern.'],

// Girls Tops
['name' => 'Rainbow Jumper', 'price' => 18.00, 'category' => 'Tops', 'gender' => 'Girls', 'description' => 'Rainbow jumper with unicorn design.'],
['name' => 'Yellow T-shirt', 'price' => 15.00, 'category' => 'Tops', 'gender' => 'Girls', 'description' => 'Yellow T-shirt with floral print.'],
['name' => 'Pink Longsleeve Shirt', 'price' => 20.00, 'category' => 'Tops', 'gender' => 'Girls', 'description' => 'Pink long-sleeve shirt with buttons.'],

// Girls Trousers
['name' => 'Pink Heart Skirt', 'price' => 15.00, 'category' => 'Trousers', 'gender' => 'Girls', 'description' => 'Pink skirt with heart patterns.'],
['name' => 'Denim Unicorn Skirt', 'price' => 15.00, 'category' => 'Trousers', 'gender' => 'Girls', 'description' => 'Denim skirt with unicorn design.'],
['name' => 'Pink Star Jeans', 'price' => 20.00, 'category' => 'Trousers', 'gender' => 'Girls', 'description' => 'Pink jeans with star details.'],
];
        foreach ($products as $productData) {
    Product::updateOrCreate(
        ['name' => $productData['name']],
        [
            'slug' => \Illuminate\Support\Str::slug($productData['name']),
            'description' => $productData['description'],
            'price' => $productData['price'],
            'stock_quantity' => rand(10, 50),
            'status' => 'active',
            'category_id' => $categories[$productData['category']]->id,
            'gender_id' => $genders[$productData['gender']]->id,
        ]
    );
}
    }
}