<?php

use Illuminate\Database\Seeder;
use Modules\Role\Entities\Role;
use Modules\User\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Khotibul Umam',
            'email' => 'khotib.umam7@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10)
        ]);
        $user->syncRoles([Role::where('name', 'admin')->first()]);
    }
}
