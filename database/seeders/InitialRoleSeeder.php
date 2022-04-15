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
        Role::create(['name' => 'Staff']);
        Role::create(['name' => 'Customer']);

        $admin_panel_permission = Permission::create(['name' => 'Administrator Module Access'])->assignRole($admin);
    }
}
