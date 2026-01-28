<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'user_id' => 4, // customer@example.com
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'customer@example.com',
                'phone' => '+1234567890',
                'is_active' => true,
                'total_spent' => 0,
                'total_orders' => 0,
            ],
            [
                'user_id' => null,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1234567891',
                'is_active' => true,
                'total_spent' => 0,
                'total_orders' => 0,
            ],
            [
                'user_id' => null,
                'first_name' => 'Robert',
                'last_name' => 'Johnson',
                'email' => 'robert.j@example.com',
                'phone' => '+1234567892',
                'is_active' => true,
                'total_spent' => 0,
                'total_orders' => 0,
            ],
        ];

        foreach ($customers as $customer) {
            DB::table('customers')->insert(array_merge($customer, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Customers seeded');
    }
}
