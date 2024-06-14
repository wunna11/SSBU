<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?string $password;

    public function run(): void
    {
        $index = Permission::create(['name' => 'index', 'guard_name' => 'admin']);
        $create = Permission::create(['name' => 'create', 'guard_name' => 'admin']);
        $show = Permission::create(['name' => 'show', 'guard_name' => 'admin']);
        $edit = Permission::create(['name' => 'edit', 'guard_name' => 'admin']);
        $delete = Permission::create(['name' => 'delete', 'guard_name' => 'admin']);

        $rootAdminRole = Role::create(['name' => 'root-admin', 'guard_name' => 'admin']);
        $rootAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $adminRole->givePermissionTo('index', 'show', 'create');

        $managerRole = Role::create(['name' => 'manager', 'guard_name' => 'admin']);
        $managerRole->givePermissionTo('index', 'create', 'show', 'edit');

        // create root-admin
        $root_admin = \App\Models\Admin::factory()->create([
            'name' => 'rootadmin',
            'email' => 'rootadmin@gmail.com',
            'password' => static::$password ??= Hash::make('123456'),
            'role_id' => Admin::ROLE_ROOT_ADMIN,
            'remember_token' => Str::random(10),
        ]);

        // create admin
        $admin = \App\Models\Admin::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => static::$password ??= Hash::make('123456'),
            'role_id' => Admin::ROLE_ADMIN,
            'remember_token' => Str::random(10),
        ]);

        // create manager
        $manager = \App\Models\Admin::factory()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => static::$password ??= Hash::make('123456'),
            'role_id' => Admin::ROLE_MANAGER,
            'remember_token' => Str::random(10),
        ]);

        $root_admin->assignRole($rootAdminRole);
        $admin->assignRole($adminRole);
        $manager->assignRole($managerRole);
    }
}
