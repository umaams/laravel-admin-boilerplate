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
        $menus = Menu::orderBy('parent_menu_id')->orderBy('item_order')->get();
        \Menu::make('MyNavBar', function ($menu) use ($menus) {
            foreach ($menus as $item) {
                if ($item->parent_menu_id == 0) {
                    if ($item->link != '#') {
                        $menu->add($item->name, ['url' => $item->link, 'id' => $item->id]);
                    } else {
                        $menu->add($item->name, ['id' => $item->id]);
                    }
                } else {
                    if ($item->link != '#') {
                        $menu->find($item->parent_menu_id)->add($item->name, ['url' => $item->link, 'id' => $item->id]);
                    } else {
                        $menu->find($item->parent_menu_id)->add($item->name, ['id' => $item->id]);
                    }
                }
            }
        });
        return $next($request);
    }
}
