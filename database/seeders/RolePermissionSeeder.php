<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        // Membuat permission
        // $viewDashboardPermission = Permission::create(['name' => 'view dashboard']);
        // $viewPostPermission = Permission::create(['name' => 'view posts']);

        // Membuat role
        $adminRole = Role::create(['name' => 'admin']);
        // $userRole = Role::create(['name' => 'user']);

        // Menetapkan permission ke role
        // $adminRole->givePermissionTo($viewDashboardPermission);
        // $userRole->givePermissionTo($viewPostPermission);

        $user->assignRole($adminRole); // Berikan role admin ke pengguna
    }
}
