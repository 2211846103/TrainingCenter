<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::createOrFirst(['name' => 'admin']);
        $instructor = Role::createOrFirst(['name' => 'instructor']);
        $client = Role::createOrFirst(['name' => 'client']);

        Permission::create(['name' => 'enroll']);
        Permission::create(['name' => 'view course students']);
        Permission::create(['name' => 'manage courses']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage course materials']);
        Permission::create(['name' => 'view course materials']);
        Permission::create(['name' => 'download certificate']);

        $admin->givePermissionTo([
            'manage courses',
            'manage users'
        ]);
        $instructor->givePermissionTo([
            'view course students',
            'manage course materials'
        ]);
        $client->givePermissionTo([
            'enroll',
            'view course materials',
            'download certificate'
        ]);
    }
}
