<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Product Permissions
        Permission::firstOrCreate(['name' => 'product.view']);
        Permission::firstOrCreate(['name' => 'product.create']);
        Permission::firstOrCreate(['name' => 'product.edit']);
        Permission::firstOrCreate(['name' => 'product.delete']);

        // Category Permissions
        Permission::firstOrCreate(['name' => 'category.view']);
        Permission::firstOrCreate(['name' => 'category.create']);
        Permission::firstOrCreate(['name' => 'category.edit']);
        Permission::firstOrCreate(['name' => 'category.delete']);

        // Order Permissions
        Permission::firstOrCreate(['name' => 'order.view']);
        Permission::firstOrCreate(['name' => 'order.create']);
        Permission::firstOrCreate(['name' => 'order.edit']);
        Permission::firstOrCreate(['name' => 'order.delete']);

        // Customer Unit Permissions
        Permission::firstOrCreate(['name' => 'customer_unit.view']);
        Permission::firstOrCreate(['name' => 'customer_unit.create']);
        Permission::firstOrCreate(['name' => 'customer_unit.edit']);
        Permission::firstOrCreate(['name' => 'customer_unit.delete']);

        // Site Permissions
        Permission::firstOrCreate(['name' => 'site.view']);
        Permission::firstOrCreate(['name' => 'site.create']);
        Permission::firstOrCreate(['name' => 'site.edit']);
        Permission::firstOrCreate(['name' => 'site.delete']);

        // User Permissions (for legacy compatibility)
        Permission::firstOrCreate(['name' => 'user.view']);
        Permission::firstOrCreate(['name' => 'user.create']);
        Permission::firstOrCreate(['name' => 'user.edit']);
        Permission::firstOrCreate(['name' => 'user.delete']);

        // User Permissions (for legacy compatibility)
        Permission::firstOrCreate(['name' => 'role.view']);
        Permission::firstOrCreate(['name' => 'role.create']);
        Permission::firstOrCreate(['name' => 'role.edit']);
        Permission::firstOrCreate(['name' => 'role.delete']);

        // Admin gets all permissions
        $admin->givePermissionTo(Permission::all());
        
        // User gets only view and edit permissions for products and orders
        $user->givePermissionTo([
            'product.view',
            'product.edit',
            'order.view',
            'order.edit',
            'customer_unit.view',
            'category.view',
        ]);
    }
}
