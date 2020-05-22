<?php

namespace Modules\Permission\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Permission\Http\Requests\StorePermissionRequest;
use Modules\Permission\Http\Requests\UpdatePermissionRequest;
use Modules\Permission\Entities\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = Permission::where('parent_permission_id', '0')->with('childrenPermissions')->get();
        return view('permission::index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();
        return view('permission::create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StorePermissionRequest $request)
    {
        if ($request->parent_permission_id != 0) {
            $parentPermission = Permission::findOrFail($request->parent_permission_id);
            $request->merge(['name' => $parentPermission->name.".".$request->name]);
        }
        $permission = Permission::create($request->all());
        return redirect('/permissions');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::with(['parent_permission'])->findOrFail($id);
        $permissions = Permission::whereNotIn('id', [$permission->id])->orderBy('name')->get();
        return view('permission::edit', compact('permission', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        if ($request->parent_permission_id != 0) {
            $parentPermission = Permission::findOrFail($request->parent_permission_id);
            $request->merge(['name' => $parentPermission->name.".".$request->name]);
        }
        $permission = Permission::findOrFail($id)->update($request->all());
        return redirect('/permissions');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        return redirect('/permissions');
    }
}
