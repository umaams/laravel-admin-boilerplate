<?php

namespace Modules\Permission\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
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
        return view('permission::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('permission::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StorePermissionRequest $request)
    {
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
        $permission = Permission::findOrFail($id);
        return view('permission::edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id)->update($request->only(['display_name', 'description']));
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

    public function datatable(Request $request)
    {
        $permissions = Permission::select(['id', 'name', 'display_name', 'description', 'created_at', 'updated_at']);

        return Datatables::of($permissions)
        ->addColumn('action', function ($permission) {
            $text = "";
            $text.= '<a href="'.url('permissions/'.$permission->id.'/edit').'" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> '.__('navigation.edit').'</a>';
            $text.= "<form class='form-horizontal' style='display: inline;' method='POST' action='".url('permissions/'.$permission->id)."'><input type='hidden' name='_token' value='".csrf_token()."'> <input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> ".__('navigation.delete')."</button></form><form>";
            return $text;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
