<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InitialRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrator']);
        $staff = Role::create(['name' => 'Staff']);
        Role::create(['name' => 'Customer']);

        Permission::create(['name' => 'View Product Categories', 'category' => 'Product Categories'])->assignRole($admin);
        Permission::create(['name' => 'Add Product Categories', 'category' => 'Product Categories'])->assignRole($admin);
        Permission::create(['name' => 'Edit Product Categories', 'category' => 'Product Categories'])->assignRole($admin);
        Permission::create(['name' => 'Export Product Categories', 'category' => 'Product Categories'])->assignRole($admin);

        Permission::create(['name' => 'View Products', 'category' => 'Products'])->assignRole($admin);
        Permission::create(['name' => 'Add Products', 'category' => 'Products'])->assignRole($admin);
        Permission::create(['name' => 'Edit Products', 'category' => 'Products'])->assignRole($admin);
        Permission::create(['name' => 'Export Products', 'category' => 'Products'])->assignRole($admin);

        Permission::create(['name' => 'View Units of measure', 'category' => 'Units of measure'])->assignRole($admin);
        Permission::create(['name' => 'Add Units of measure', 'category' => 'Units of measure'])->assignRole($admin);
        Permission::create(['name' => 'Edit Units of measure', 'category' => 'Units of measure'])->assignRole($admin);
        Permission::create(['name' => 'Export Units of measure', 'category' => 'Units of measure'])->assignRole($admin);

        Permission::create(['name' => 'View Staff', 'category' => 'Staff'])->assignRole($admin);
        Permission::create(['name' => 'Add Staff', 'category' => 'Staff'])->assignRole($admin);
        Permission::create(['name' => 'Edit Staff', 'category' => 'Staff'])->assignRole($admin);
        Permission::create(['name' => 'Export Staff', 'category' => 'Staff'])->assignRole($admin);

        Permission::create(['name' => 'Change Product Image', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Change Product Status', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Change Product Tags', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Modify Product Gallery', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Change Product Units', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Change Product Prices', 'category' => 'Product Details'])->assignRole($admin);
        Permission::create(['name' => 'Modify Product Stock', 'category' => 'Product Details'])->assignRole($admin);

        Permission::create(['name' => 'View Branch Offices', 'category' => 'Branch Offices'])->assignRole($admin);
        Permission::create(['name' => 'Add Branch Office', 'category' => 'Branch Offices'])->assignRole($admin);
        Permission::create(['name' => 'Edit Branch Office', 'category' => 'Branch Offices'])->assignRole($admin);
        Permission::create(['name' => 'Export Branch Offices', 'category' => 'Branch Offices'])->assignRole($admin);

        Permission::create(['name' => 'View Postal Code Coverage', 'category' => 'Postal Code Coverage'])->assignRole($admin);
        Permission::create(['name' => 'Add Postal Code Coverage', 'category' => 'Postal Code Coverage'])->assignRole($admin);
        Permission::create(['name' => 'Edit Postal Code Coverage', 'category' => 'Postal Code Coverage'])->assignRole($admin);
        Permission::create(['name' => 'Export Postal Code Coverage', 'category' => 'Postal Code Coverage'])->assignRole($admin);
    }
}
