<?php

namespace Modules\Menu\Http\Middleware;

use Closure;
use Modules\Menu\Entities\Menu;

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
        $menus = Menu::where('active', '1')->orderBy('parent_menu_id')->orderBy('item_order')->get();
        \Menu::make('MyNavBar', function ($menu) use ($menus) {
            foreach ($menus as $item) {
                if ($item->parent_menu_id == 0) {
                    if ($item->link != '#') {
                        $menu->add($item->name, ['url' => $item->link, 'id' => $item->id])->data('icon', $item->fa_class);
                    } else {
                        $menu->add($item->name, ['id' => $item->id])->data('icon', $item->fa_class);
                    }
                } else {
                    if ($item->link != '#') {
                        $parent = $menu->find($item->parent_menu_id);
                        if ($parent) {
                            $parent->add($item->name, ['url' => $item->link, 'id' => $item->id])->data('icon', $item->fa_class);
                        }
                    } else {
                        $parent = $menu->find($item->parent_menu_id);
                        if ($parent) {
                            $parent->add($item->name, ['id' => $item->id])->data('icon', $item->fa_class);
                        }
                    }
                }
            }
        });
        return $next($request);
    }
}
