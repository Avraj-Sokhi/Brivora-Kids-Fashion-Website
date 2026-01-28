<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            [
                'customer_id' => 1,
                'type' => 'shipping',
                'address_line1' => '123 Main Street',
                'address_line2' => 'Apt 4B',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'US',
                'is_default' => true,
            ],
            [
                'customer_id' => 1,
                'type' => 'billing',
                'address_line1' => '123 Main Street',
                'address_line2' => 'Apt 4B',
                'city' => 'New York',
                'state' => 'NY',
                'postal_code' => '10001',
                'country' => 'US',
                'is_default' => true,
            ],
            [
                'customer_id' => 2,
                'type' => 'shipping',
                'address_line1' => '456 Oak Avenue',
                'address_line2' => null,
                'city' => 'Los Angeles',
                'state' => 'CA',
                'postal_code' => '90001',
                'country' => 'US',
                'is_default' => true,
            ],
        ];

        foreach ($addresses as $address) {
            DB::table('addresses')->insert(array_merge($address, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✓ Addresses seeded');
    }
}
