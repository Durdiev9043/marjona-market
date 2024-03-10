<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $role1 = Role::create(['name' => 'client']);
        $role2 = Role::create(['name' => 'supplier']);

        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $admin = User::create([
            'name' => 'admin',
            'phone' => '997484390',
            'password' => bcrypt('admin'),
            'role' => 1
        ],);








        $admin->assignRole([$role->id]);

    }

}
