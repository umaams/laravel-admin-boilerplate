<?php

namespace Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Http\Requests\StoreMenuRequest;
use Modules\Menu\Http\Requests\UpdateMenuRequest;
use Modules\Permission\Entities\Permission;
use Modules\Menu\Entities\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $menus = Menu::where('parent_menu_id', '0')->with('childrenMenus')->get();
        return view('menu::index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $menus = Menu::orderBy('name')->get();
        $permissions = Permission::orderBy('display_name')->get();
        return view('menu::create', compact('menus', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->all());
        return redirect('/menus');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('menu::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $menu = Menu::with(['parent_menu'])->findOrFail($id);
        $menus = Menu::whereNotIn('id', [$menu->id])->orderBy('name')->get();
        $permissions = Permission::orderBy('display_name')->get();
        return view('menu::edit', compact('menu', 'menus', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateMenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id)->update($request->all());
        return redirect('/menus');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect('/menus');
    }
}
