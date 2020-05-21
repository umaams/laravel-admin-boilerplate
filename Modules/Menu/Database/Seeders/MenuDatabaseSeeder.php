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
        $manufacture = Menu::create(['name' => 'Manufacture', 'link' => '#', 'item_order' => '2', 'parent_menu_id' => 0]);
        $material = Menu::create(['name' => 'Materials', 'link' => 'materials', 'parent_menu_id' => $manufacture->id]);
        $customer = Menu::create(['name' => 'Customers', 'link' => 'customers', 'parent_menu_id' => $manufacture->id]);
        $routing = Menu::create(['name' => 'Routings', 'link' => 'routings', 'parent_menu_id' => $manufacture->id]);
        $bom = Menu::create(['name' => 'Bill of Materials', 'link' => 'boms', 'parent_menu_id' => $manufacture->id]);
    }
}
