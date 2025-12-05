<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map product names to their image paths
        $productImages = [
            // Boys Accessories
            'Minecraft Beanie' => 'images/Accessory 1.png',
            'Fleece Mittens' => 'images/Accessory 2.png',
            'Kids Backpack' => 'images/Accessory 3.png',

            // Boys Outerwear
            'Rabbit Jacket' => 'images/Outerwear 1.png',
            'Puffer Jacket' => 'images/Outerwear 2.png',
            'Tractor Fleece' => 'images/Outerwear 3.png',

            // Boys Shoes
            'Black High Top' => 'images/Shoe 1.png',
            'Marvel Sneaker' => 'images/Shoe 2.png',
            'Jurassic Sneaker' => 'images/Shoe 3.png',

            // Boys Tops
            'Navy Polo Shirt' => 'images/Top 1.png',
            'Racecar Shirt' => 'images/Top 2.png',
            'Dinosaur Shirt' => 'images/Top 3.png',

            // Boys Trousers
            'Planet Joggers' => 'images/Trousers 1.png',
            'Dino Joggers' => 'images/Trousers 2.png',
            'Pokémon Joggers' => 'images/Trousers 3.png',

            // Girls Accessories
            'Pink Backpack' => 'images/girls accesories 1.png',
            'Pink Barbie Cap' => 'images/girls accesories 2.png',
            'Pink Hat and Mittens' => 'images/girls accesories 3.png',

            // Girls Outerwear
            'Pink Cardigan Fleece' => 'images/girls outerwear 1.png',
            'Fluffy Fleece' => 'images/girls outerwear 2.png',
            'Denim Jacket' => 'images/girls outerwear 3.png',

            // Girls Shoes
            'Pink Trainers' => 'images/girls shoes 1.png',
            'Pink Heels' => 'images/girls shoes 2.png',
            'Pink Pumps' => 'images/girls shoes 3.png',

            // Girls Tops
            'Rainbow Jumper' => 'images/girls top 1.png',
            'Yellow T-shirt' => 'images/girls top 2.png',
            'Pink Longsleeve Shirt' => 'images/girls top 3.png',

            // Girls Bottoms
            'Pink Heart Skirt' => 'images/girls bottom 1.png',
            'Denim Unicorn Skirt' => 'images/girls bottom 2.png',
            'Pink Star Jeans' => 'images/girls bottom 3.png',
        ];

        foreach ($productImages as $productName => $imagePath) {
            $product = Product::where('name', $productName)->first();

            if ($product) {
                // Create image record for this product
                Image::create([
                    'product_id' => $product->id,
                    'image_url' => $imagePath,
                    'is_primary' => true,
                ]);

                $this->command->info("Added image for: {$productName}");
            } else {
                $this->command->warn("Product not found: {$productName}");
            }
        }

        $this->command->info('Product images seeded successfully!');
    }
}
