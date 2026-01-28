<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderStatusHistorySeeder extends Seeder
{
    public function run(): void
    {
        $statusHistory = [
            ['order_id' => 1, 'status' => 'pending', 'notes' => 'Order created', 'changed_by' => null],
            ['order_id' => 2, 'status' => 'pending', 'notes' => 'Order created', 'changed_by' => null],
            ['order_id' => 2, 'status' => 'processing', 'notes' => 'Payment confirmed', 'changed_by' => 1],
            ['order_id' => 3, 'status' => 'pending', 'notes' => 'Order created', 'changed_by' => null],
            ['order_id' => 3, 'status' => 'processing', 'notes' => 'Payment confirmed', 'changed_by' => 1],
            ['order_id' => 3, 'status' => 'shipped', 'notes' => 'Order shipped via FedEx', 'changed_by' => 1],
            ['order_id' => 4, 'status' => 'pending', 'notes' => 'Order created', 'changed_by' => null],
            ['order_id' => 4, 'status' => 'processing', 'notes' => 'Payment confirmed', 'changed_by' => 1],
            ['order_id' => 4, 'status' => 'shipped', 'notes' => 'Order shipped', 'changed_by' => 1],
            ['order_id' => 4, 'status' => 'delivered', 'notes' => 'Order delivered', 'changed_by' => 1],
        ];

        foreach ($statusHistory as $history) {
            DB::table('order_status_history')->insert(array_merge($history, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Order status history seeded');
    }
}
