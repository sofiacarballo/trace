<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('haveaccess', 'role.index');
        $roles=role::all();
        return view('role.index',compact('roles'));
    }

    public function create()
    {
        Gate::authorize('haveaccess', 'role.create');
        $permissions=Permission::all();
        return view('role.create',['permissions'=>$permissions]);
    }

    public function store(Request $request)
    {
        Gate::authorize('haveaccess', 'role.create');
        $role=Role::create($request->all());
        $role->permissions()->sync($request->get('permission'));
        return redirect(route('role.index'))->with('status_success','Role created successfully');
    }

    public function show(role $role)
    {
        Gate::authorize('haveaccess', 'role.show');
        return view('role.show', ['role'=>$role]);
    }

    public function edit(role $role)
    {
        Gate::authorize('haveaccess', 'role.edit');
        $permissions=Permission::all();
        return view('role.edit',['role'=>$role, 'permissions'=>$permissions]);
    }

    public function update(Request $request, role $role)
    {
        Gate::authorize('haveaccess','role.edit');
        if ($role->name != 'admin'){
            $role->update($request->all());
            $role->permissions()->sync($request->get('permission'));
            return redirect()->route('role.index')->with('status_success','Role updated successfully');
        }
    }

    public function destroy(role $role)
    {
        Gate::authorize('haveaccess','role.destroy');
        if ($role->name != 'admin'){
            $role->delete();
            return redirect (route('role.index'))->with('status_success','Role deleted successfully');;
        }
    }
}
