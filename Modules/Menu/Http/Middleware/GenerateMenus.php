<?php

namespace Modules\Menu\Http\Middleware;

use Closure;
use Modules\Menu\Entities\Menu;
use Modules\User\Entities\User;
use Auth;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permissions = [];
        if (Auth::check()) {
            $permissions = Auth::user()->allPermissions();
        }
        $menus = Menu::where('active', '1')->orderBy('parent_menu_id')->orderBy('item_order')->get();
        \Menu::make('MyNavBar', function ($menu) use ($menus) {
            foreach ($menus as $item) {
                if ($item->parent_menu_id == 0) {
                    if ($item->link != '#') {
                        $menu->add($item->name, ['url' => $item->link, 'id' => $item->id])->data('icon', $item->fa_class)->data('permission_id', $item->permission_id);
                    } else {
                        $menu->add($item->name, ['id' => $item->id])->data('icon', $item->fa_class)->data('permission_id', $item->permission_id);
                    }
                } else {
                    if ($item->link != '#') {
                        $parent = $menu->find($item->parent_menu_id);
                        if ($parent) {
                            $parent->add($item->name, ['url' => $item->link, 'id' => $item->id])->data('permission_id', $item->permission_id)->data('icon', $item->fa_class);
                        }
                    } else {
                        $parent = $menu->find($item->parent_menu_id);
                        if ($parent) {
                            $parent->add($item->name, ['id' => $item->id])->data('permission_id', $item->permission_id)->data('icon', $item->fa_class);
                        }
                    }
                }
            }
        })->filter(function($item) use ($permissions) {
            if (Auth::check()) {
                if ($item->data('permission_id') != 0) {
                    $permission = $permissions->where('id', $item->data('permission_id'))->first();
                    if ($permission) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            }
            return false;
          });
        return $next($request);
    }
}
