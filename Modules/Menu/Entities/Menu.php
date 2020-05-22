<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'link', 'fa_class', 'description', 'item_order', 'parent_menu_id', 'permission_id', 'active'];

    public function menus()
    {
        return $this->hasMany('Modules\Menu\Entities\Menu', 'parent_menu_id', 'id');
    }

    public function childrenMenus()
    {
        return $this->hasMany('Modules\Menu\Entities\Menu', 'parent_menu_id', 'id')->with('menus');
    }

    public function parent_menu()
    {
        return $this->belongsTo('Modules\Menu\Entities\Menu', 'parent_menu_id', 'id');
    }
}
