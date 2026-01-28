<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            AdminUserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            AddressSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            OrderStatusHistorySeeder::class,
            AdminNotificationSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('✓✓✓ Database seeding completed successfully! ✓✓✓');
        $this->command->info('');
    }
}
