<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => PermissionEnum::CREATE_TASK]);
        Permission::create(['name' => PermissionEnum::EDIT_TASK]);
        Permission::create(['name' => PermissionEnum::VIEW_TASK]);
        Permission::create(['name' => PermissionEnum::DELETE_TASK]);
        Permission::create(['name' => PermissionEnum::EDIT_ALL_TASK]);
        Permission::create(['name' => PermissionEnum::VIEW_ALL_TASK]);
        Permission::create(['name' => PermissionEnum::DELETE_ALL_TASK]);

        $role = Role::create(['name' => RoleEnum::SUPER_ADMIN])
            ->givePermissionTo(Permission::all());
        $role = Role::create(['name' => RoleEnum::ADMIN])
            ->givePermissionTo(Permission::all());
        $role = Role::create(['name' => RoleEnum::USER])
            ->givePermissionTo(Permission::all());
    }
}
