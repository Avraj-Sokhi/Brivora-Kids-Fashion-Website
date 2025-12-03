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
            'Minecraft Beanie' => 'images for website/Accessory 1.png',
            'Fleece Mittens' => 'images for website/Accessory 2.png',
            'Kids Backpack' => 'images for website/Accessory 3.png',

            // Boys Outerwear
            'Rabbit Jacket' => 'images for website/Outerwear 1.png',
            'Puffer Jacket' => 'images for website/Outerwear 2.png',
            'Tractor Fleece' => 'images for website/Outerwear 3.png',

            // Boys Shoes
            'Black High Top' => 'images for website/Shoe 1.png',
            'Marvel Sneaker' => 'images for website/Shoe 2.png',
            'Jurassic Sneaker' => 'images for website/Shoe 3.png',

            // Boys Tops
            'Navy Polo Shirt' => 'images for website/Top 1.png',
            'Racecar Shirt' => 'images for website/Top 2.png',
            'Dinosaur Shirt' => 'images for website/Top 3.png',

            // Boys Trousers
            'Planet Joggers' => 'images for website/Trousers 1.png',
            'Dino Joggers' => 'images for website/Trousers 2.png',
            'Pokémon Joggers' => 'images for website/Trousers 3.png',

            // Girls Accessories
            'Pink Backpack' => 'images for website/girls accesories 1.png',
            'Pink Cap' => 'images for website/girls accesories 2.png',
            'Pink Hat and Mittens' => 'images for website/girls accesories 3.png',

            // Girls Outerwear
            'Fluffy Flower Fleece' => 'images for website/girls outerwear 1.png',
            'Fluffy Fleece' => 'images for website/girls outerwear 2.png',
            'Denim Jacket' => 'images for website/girls outerwear 3.png',

            // Girls Shoes
            'Pink Trainers' => 'images for website/girls shoes 1.png',
            'Heels' => 'images for website/girls shoes 2.png',
            'Pumps' => 'images for website/girls shoes 3.png',

            // Girls Tops
            'Jumper' => 'images for website/girls top 1.png',
            'T-shirt' => 'images for website/girls top 2.png',
            'Longsleeve Shirt' => 'images for website/girls top 3.png',

            // Girls Bottoms
            'Skirt' => 'images for website/girls bottom 1.png',
            'Denim Skirt' => 'images for website/girls bottom 2.png',
            'Denim Jeans' => 'images for website/girls bottom 3.png',
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
