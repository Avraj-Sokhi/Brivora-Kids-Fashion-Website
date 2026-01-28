<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orderItems = [
            // Order 1 items
            [
                'order_id' => 1,
                'product_id' => 1,
                'product_name' => 'Wireless Bluetooth Headphones',
                'product_sku' => 'WBH-001',
                'quantity' => 1,
                'unit_price' => 79.99,
                'total_price' => 79.99,
            ],
            [
                'order_id' => 1,
                'product_id' => 3,
                'product_name' => 'LED Desk Lamp',
                'product_sku' => 'LDL-001',
                'quantity' => 1,
                'unit_price' => 49.99,
                'total_price' => 49.99,
            ],
            // Order 2 items
            [
                'order_id' => 2,
                'product_id' => 1,
                'product_name' => 'Wireless Bluetooth Headphones',
                'product_sku' => 'WBH-001',
                'quantity' => 1,
                'unit_price' => 79.99,
                'total_price' => 79.99,
            ],
            // Order 3 items
            [
                'order_id' => 3,
                'product_id' => 3,
                'product_name' => 'LED Desk Lamp',
                'product_sku' => 'LDL-001',
                'quantity' => 1,
                'unit_price' => 39.99,
                'total_price' => 39.99,
            ],
            // Order 4 items
            [
                'order_id' => 4,
                'product_id' => 7,
                'product_name' => 'Running Shoes',
                'product_sku' => 'RNS-001',
                'quantity' => 1,
                'unit_price' => 89.99,
                'total_price' => 89.99,
            ],
        ];

        foreach ($orderItems as $item) {
            DB::table('order_items')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Order items seeded');
    }
}
