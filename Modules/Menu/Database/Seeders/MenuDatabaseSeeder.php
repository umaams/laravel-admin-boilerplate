<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Menu\Entities\Menu;

class MenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $home = Menu::create(['name' => 'Home', 'link' => 'home', 'item_order' => '0', 'parent_menu_id' => 0]);
        $auth = Menu::create(['name' => 'Auth', 'link' => '#', 'item_order' => '1', 'parent_menu_id' => 0]);
        $permission = Menu::create(['name' => 'Permissions', 'link' => 'permissions', 'parent_menu_id' => $auth->id]);
        $role = Menu::create(['name' => 'Roles', 'link' => 'roles', 'parent_menu_id' => $auth->id]);
        $user = Menu::create(['name' => 'Users', 'link' => 'users', 'parent_menu_id' => $auth->id]);
        $menu = Menu::create(['name' => 'Menus', 'link' => 'menus', 'parent_menu_id' => $auth->id]);
    }
}
