<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'link', 'description', 'item_order', 'parent_menu_id', 'active'];
}
