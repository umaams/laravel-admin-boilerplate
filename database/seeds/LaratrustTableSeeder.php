<?php

use Illuminate\Database\Seeder;
use Modules\Permission\Entities\Permission;
use Modules\Role\Entities\Role;

class LaratrustTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userView = Permission::create([
            'name' => 'user.view',
            'display_name' => 'View User',
            'description' => 'View all users'
        ]);
        $userCreate = Permission::create([
            'name' => 'user.create',
            'display_name' => 'Create User',
            'description' => 'Create new user'
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Administrator user role'
        ]);
        $admin->syncPermissions([$userView, $userCreate]);
    }
}
