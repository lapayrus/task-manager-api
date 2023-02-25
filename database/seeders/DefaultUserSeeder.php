<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => env('SUPERADMIN_USERNAME'),
            'email' => env('SUPERADMIN_EMAIL'),
            'password' => bcrypt(env('SUPERADMIN_PASSWORD'))
        ]);

        $superadmin = Role::where('name', RoleEnum::SUPER_ADMIN)->first();

        $user->assignRole($superadmin);
    }
}
