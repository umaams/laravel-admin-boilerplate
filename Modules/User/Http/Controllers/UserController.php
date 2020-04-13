<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Http\Requests\UpdatePasswordRequest;
use Modules\User\Entities\User;
use Modules\Role\Entities\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $json = file_get_contents(base_path('timezones.json'));
        $timezones = json_decode($json, true);
        $roles = Role::orderBy('name')->get();
        return view('user::create', compact('roles', 'timezones'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $user->syncRoles([$request->role_id]);
        return redirect('/users');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::with('permissions')->findOrFail($id);
        return view('user::show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $json = file_get_contents(base_path('timezones.json'));
        $timezones = json_decode($json, true);
        $roles = Role::orderBy('name')->get();
        $role_ids = $user->roles->pluck('id')->all();
        return view('user::edit', compact('user', 'roles', 'timezones', 'role_ids'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->timezone_code = $request->timezone_code;
        $user->language_code = $request->language_code;
        $user->save();
        $user->syncRoles([$request->role_id]);
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/users');
    }

    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/users');
    }

    public function datatable(Request $request)
    {
        $users = User::with(['roles'])->select(['id', 'name', 'email']);

        return Datatables::of($users)
        ->editColumn('roles', function ($user) {
            return implode(', ', $user->roles->pluck('display_name')->all());
        })
        ->addColumn('action', function ($user) {
            $text = "";
            $text.= '<a href="'.url('users/'.$user->id).'" type="button" class="btn btn-sm btn-info"><i class="fa fa-info"></i> '.__('navigation.show').'</a>';
            $text.= ' <a href="'.url('users/'.$user->id.'/edit').'" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> '.__('navigation.edit').'</a>';
            $text.= "<form class='form-horizontal' style='display: inline;' method='POST' action='".url('users/'.$user->id)."'><input type='hidden' name='_token' value='".csrf_token()."'> <input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> ".__('navigation.delete')."</button></form><form>";
            return $text;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
