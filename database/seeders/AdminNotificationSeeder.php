<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminNotificationSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [
            [
                'type' => 'low_stock',
                'title' => 'Low Stock Alert',
                'message' => 'Cotton T-Shirt is running low on stock (3 units remaining)',
                'link' => '/admin/products/2',
                'is_read' => false,
            ],
            [
                'type' => 'low_stock',
                'title' => 'Low Stock Alert',
                'message' => 'Yoga Mat is running low on stock (2 units remaining)',
                'link' => '/admin/products/5',
                'is_read' => false,
            ],
            [
                'type' => 'order',
                'title' => 'New Order Received',
                'message' => 'Order #ORD-12345678 is pending processing',
                'link' => '/admin/orders/1',
                'is_read' => false,
            ],
            [
                'type' => 'order',
                'title' => 'Order Delivered',
                'message' => 'Order #ORD-87654321 has been delivered',
                'link' => '/admin/orders/4',
                'is_read' => true,
                'read_at' => now()->subDays(1),
            ],
        ];

        foreach ($notifications as $notification) {
            DB::table('admin_notifications')->insert(array_merge($notification, [
                'created_at' => now()->subHours(rand(1, 48)),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Admin notifications seeded');
    }
}
