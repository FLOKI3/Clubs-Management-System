<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'Dashboard access']);
        Permission::create(['name' => 'Manage users']);
        Permission::create(['name' => 'Add roles']);
        Permission::create(['name' => 'Delete users']);
        Permission::create(['name' => 'Manage roles']);
        Permission::create(['name' => 'Create roles']);
        Permission::create(['name' => 'Edit roles']);
        Permission::create(['name' => 'Delete roles']);
        Permission::create(['name' => 'Manage permissions']);
        Permission::create(['name' => 'Create permissions']);
        Permission::create(['name' => 'Edit permissions']);
        Permission::create(['name' => 'Delete permissions']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'Dashboard access',
                'Manage users',
                'Add roles',
                'Delete users',
                'Manage roles',
                'Create roles',
                'Edit roles',
                'Delete roles',
                'Manage permissions',
                'Create permissions',
                'Edit permissions',
                'Delete permissions',
            ]);

        Role::create(['name' => 'manager'])
            ->givePermissionTo([
                'Dashboard access',
                'Manage users',
                'Add roles',
                'Delete users',
                'Manage roles',
                'Create roles',
                'Edit roles',
                'Delete roles',
            ]);

        Role::create(['name' => 'developer'])
            ->givePermissionTo([
                'Dashboard access',
                'Manage users',
                'Add roles',
                'Delete users',
                'Manage permissions',
                'Create permissions',
                'Edit permissions',
                'Delete permissions',
            ]);

        Role::create(['name' => 'user']);
    }
}
