<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\ImageService;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::createOrFirst(['name' => 'admin']);
        $instructorRole = Role::createOrFirst(['name' => 'instructor']);
        $clientRole = Role::createOrFirst(['name' => 'client']);

        Permission::createOrFirst(['name' => 'enroll']);
        Permission::createOrFirst(['name' => 'view course students']);
        Permission::createOrFirst(['name' => 'manage courses']);
        Permission::createOrFirst(['name' => 'manage users']);
        Permission::createOrFirst(['name' => 'manage course materials']);
        Permission::createOrFirst(['name' => 'view course materials']);
        Permission::createOrFirst(['name' => 'download certificate']);

        $adminRole->givePermissionTo([
            'manage courses',
            'manage users'
        ]);
        $instructorRole->givePermissionTo([
            'view course students',
            'manage course materials'
        ]);
        $clientRole->givePermissionTo([
            'enroll',
            'view course materials',
            'download certificate'
        ]);

        $admin = User::create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => "admin",
            "profile_image" => ImageService::generate()
        ]);
        $admin->assignRole('admin');
    }
}
