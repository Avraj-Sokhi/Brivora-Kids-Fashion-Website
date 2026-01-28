<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Dashboard
            'view dashboard',
            
            // Products
            'view products',
            'create products',
            'edit products',
            'delete products',
            
            // Orders
            'view orders',
            'edit orders',
            'delete orders',
            'process orders',
            
            // Customers
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
            
            // Users & Roles
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            
            // Settings
            'manage settings',
            
            // Reports
            'view reports',
            'export reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('Permissions created successfully!');

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $this->command->info('Roles created successfully!');

        // Assign all permissions to admin
        $adminRole->syncPermissions(Permission::all());
        $this->command->info('Admin role: All permissions assigned');

        

        $this->command->info('✓ All roles and permissions configured!');
    }
}
