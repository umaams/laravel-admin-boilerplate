<?php

namespace Modules\Role\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\Role\Http\Requests\StoreRoleRequest;
use Modules\Role\Http\Requests\UpdateRoleRequest;
use Modules\Role\Entities\Role;
use Modules\Permission\Entities\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('role::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::where('parent_permission_id', '0')->with('childrenPermissions')->get();
        $permission_ids = [];
        return view('role::create', compact('permissions', 'permission_ids'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->syncPermissions($request->permission_id);
        return redirect('/roles');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('role::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::where('parent_permission_id', '0')->with('childrenPermissions')->get();
        $permission_ids = $role->permissions->pluck('id')->all();
        return view('role::edit', compact('role', 'permissions', 'permission_ids'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->update($request->only(['display_name', 'description']));
        $role->syncPermissions($request->permission_id);
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();
        return redirect('/roles');
    }

    public function datatable(Request $request)
    {
        $roles = Role::select(['id', 'name', 'display_name', 'description', 'created_at', 'updated_at']);

        return Datatables::of($roles)
        ->addColumn('action', function ($role) {
            $text = "";
            $text.= '<a href="'.url('roles/'.$role->id.'/edit').'" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> '.__('navigation.edit').'</a>';
            $text.= "<form class='form-horizontal' style='display: inline;' method='POST' action='".url('roles/'.$role->id)."'><input type='hidden' name='_token' value='".csrf_token()."'> <input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> ".__('navigation.delete')."</button></form><form>";
            return $text;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
