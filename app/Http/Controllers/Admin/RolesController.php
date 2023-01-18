<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);
        $role = Role::create($validated);
        return redirect()->route('admin.roles.index')->with('message', 'Role created successfully');
    }

    public function edit(Role $role){

        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role){
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        $role->fill($request->post())->save();

        return redirect()->route('admin.roles.index')->with('message', 'Role updated successfully');
    }

    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('admin.roles.index')->with('message', 'Role deleted successfully!');
    }

    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission already assigned to this role!');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission assigned to this role!');
    }

    public function removePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission removed from this role!');
        }
        return back()->with('message', 'Permission not assigned to this role!');
    }
}
