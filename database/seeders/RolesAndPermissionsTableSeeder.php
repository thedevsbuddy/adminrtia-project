<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'super_admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        Permission::firstOrCreate(['name' => 'manage_resources']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage_users']);
        $managePermissions = Permission::firstOrCreate(['name' => 'manage_permissions']);
        $manageTemplates = Permission::firstOrCreate(['name' => 'manage_mail_templates']);
        $manageSettings = Permission::firstOrCreate(['name' => 'manage_settings']);

        $admin->givePermissionTo($manageUsers);
        $admin->givePermissionTo($managePermissions);
        $admin->givePermissionTo($manageUsers);
        $admin->givePermissionTo($manageTemplates);
        $admin->givePermissionTo($manageSettings);
    }
}
