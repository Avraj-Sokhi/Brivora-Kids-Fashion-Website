<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id' => 1,
                'status' => 'pending',
                'subtotal' => 129.98,
                'tax' => 10.40,
                'shipping' => 5.99,
                'discount' => 0,
                'total' => 146.37,
                'payment_method' => 'credit_card',
                'payment_status' => 'pending',
                'shipping_address_id' => 1,
                'billing_address_id' => 2,
            ],
            [
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id' => 1,
                'status' => 'processing',
                'subtotal' => 79.99,
                'tax' => 6.40,
                'shipping' => 5.99,
                'discount' => 10.00,
                'total' => 82.38,
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
                'shipping_address_id' => 1,
                'billing_address_id' => 2,
                'paid_at' => now()->subDays(2),
            ],
            [
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id' => 2,
                'status' => 'shipped',
                'subtotal' => 39.99,
                'tax' => 3.20,
                'shipping' => 5.99,
                'discount' => 0,
                'total' => 49.18,
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'shipping_address_id' => 3,
                'billing_address_id' => 3,
                'paid_at' => now()->subDays(5),
                'shipped_at' => now()->subDays(3),
            ],
            [
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'customer_id' => 2,
                'status' => 'delivered',
                'subtotal' => 89.99,
                'tax' => 7.20,
                'shipping' => 0,
                'discount' => 0,
                'total' => 97.19,
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'shipping_address_id' => 3,
                'billing_address_id' => 3,
                'paid_at' => now()->subDays(10),
                'shipped_at' => now()->subDays(8),
                'delivered_at' => now()->subDays(5),
            ],
        ];

        foreach ($orders as $order) {
            DB::table('orders')->insert(array_merge($order, [
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Orders seeded');
    }
}
