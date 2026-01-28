<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Wireless Bluetooth Headphones',
                'slug' => 'wireless-bluetooth-headphones',
                'sku' => 'WBH-001',
                'description' => 'High-quality wireless headphones with noise cancellation',
                'short_description' => 'Premium wireless headphones',
                'price' => 99.99,
                'sale_price' => 79.99,
                'cost_price' => 50.00,
                'stock_quantity' => 50,
                'low_stock_threshold' => 10,
                'category_id' => 1,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Cotton T-Shirt',
                'slug' => 'cotton-t-shirt',
                'sku' => 'CTS-001',
                'description' => '100% organic cotton t-shirt',
                'short_description' => 'Comfortable cotton tee',
                'price' => 29.99,
                'sale_price' => null,
                'cost_price' => 15.00,
                'stock_quantity' => 3,
                'low_stock_threshold' => 5,
                'category_id' => 2,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'LED Desk Lamp',
                'slug' => 'led-desk-lamp',
                'sku' => 'LDL-001',
                'description' => 'Adjustable LED desk lamp with touch controls',
                'short_description' => 'Modern LED lamp',
                'price' => 49.99,
                'sale_price' => 39.99,
                'cost_price' => 25.00,
                'stock_quantity' => 25,
                'low_stock_threshold' => 5,
                'category_id' => 3,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Programming Guide',
                'slug' => 'programming-guide',
                'sku' => 'PGD-001',
                'description' => 'Complete guide to modern programming',
                'short_description' => 'Learn programming',
                'price' => 59.99,
                'sale_price' => null,
                'cost_price' => 30.00,
                'stock_quantity' => 100,
                'low_stock_threshold' => 10,
                'category_id' => 4,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Yoga Mat',
                'slug' => 'yoga-mat',
                'sku' => 'YGM-001',
                'description' => 'Non-slip yoga mat with carrying strap',
                'short_description' => 'Premium yoga mat',
                'price' => 34.99,
                'sale_price' => 29.99,
                'cost_price' => 18.00,
                'stock_quantity' => 2,
                'low_stock_threshold' => 5,
                'category_id' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Smartphone Case',
                'slug' => 'smartphone-case',
                'sku' => 'SPC-001',
                'description' => 'Protective smartphone case',
                'short_description' => 'Durable phone case',
                'price' => 19.99,
                'sale_price' => null,
                'cost_price' => 8.00,
                'stock_quantity' => 150,
                'low_stock_threshold' => 20,
                'category_id' => 1,
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Running Shoes',
                'slug' => 'running-shoes',
                'sku' => 'RNS-001',
                'description' => 'Lightweight running shoes with cushioning',
                'short_description' => 'Comfortable running shoes',
                'price' => 89.99,
                'sale_price' => null,
                'cost_price' => 45.00,
                'stock_quantity' => 30,
                'low_stock_threshold' => 10,
                'category_id' => 5,
                'is_active' => true,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Products seeded');
    }
}