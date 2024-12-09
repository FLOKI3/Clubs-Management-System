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
        Permission::create(['name' => 'Edit users']);
        Permission::create(['name' => 'Delete users']);

        Permission::create(['name' => 'Manage roles']);
        Permission::create(['name' => 'Create roles']);
        Permission::create(['name' => 'Edit roles']);
        Permission::create(['name' => 'Delete roles']);

        Permission::create(['name' => 'Manage permissions']);
        Permission::create(['name' => 'Create permissions']);
        Permission::create(['name' => 'Edit permissions']);
        Permission::create(['name' => 'Delete permissions']);

        Permission::create(['name' => 'Manage clubs']);
        Permission::create(['name' => 'Create clubs']);
        Permission::create(['name' => 'Edit clubs']);
        Permission::create(['name' => 'Delete clubs']);

        Permission::create(['name' => 'Manage rooms']);
        Permission::create(['name' => 'Create rooms']);
        Permission::create(['name' => 'Edit rooms']);
        Permission::create(['name' => 'Delete rooms']);

        Permission::create(['name' => 'Manage lessons']);
        Permission::create(['name' => 'Create lessons']);
        Permission::create(['name' => 'Edit lessons']);
        Permission::create(['name' => 'Delete lessons']);

        Permission::create(['name' => 'Manage sessions']);
        Permission::create(['name' => 'Create sessions']);
        Permission::create(['name' => 'Edit sessions']);
        Permission::create(['name' => 'Delete sessions']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'Dashboard access',

                'Manage users',
                'Edit users',
                'Delete users',

                'Manage roles',
                'Create roles',
                'Edit roles',
                'Delete roles',

                'Manage permissions',
                'Create permissions',
                'Edit permissions',
                'Delete permissions',
                
                'Manage clubs',
                'Create clubs',
                'Edit clubs',
                'Delete clubs',

                'Manage rooms',
                'Create rooms',
                'Edit rooms',
                'Delete rooms',

                'Manage lessons',
                'Create lessons',
                'Edit lessons',
                'Delete lessons',

                'Manage sessions',
                'Create sessions',
                'Edit sessions',
                'Delete sessions',
            ]);

        Role::create(['name' => 'manager'])
            ->givePermissionTo([
                'Dashboard access',

                'Manage users',
                'Edit users',
                'Delete users',

                'Manage rooms',
                'Create rooms',
                'Edit rooms',
                'Delete rooms',

                'Manage lessons',
                'Create lessons',
                'Edit lessons',
                'Delete lessons',
                
                'Manage sessions',
                'Create sessions',
                'Edit sessions',
                'Delete sessions',
            ]);

        Role::create(['name' => 'coach'])
            ->givePermissionTo([
                'Dashboard access',
                'Manage sessions',
            ]);

    }
}
