<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function showRoles(User $user){
        $roles = $user->roles;
        return view('admin.users.roles', compact('user', 'roles'));
    }

    public function removeRoles(User $user, Role $role){
        $user->removeRole($role);
        return back();
    }

    public function showRolesPermissionAssign(User $user){
        $user_roles = $user->roles;
        $all_roles = Role::all();

        $user_permissions = $user->permissions;
        $all_permissions = Permission::all();
        return view('admin.users.roles-permissions-assign', compact('user','user_roles', 'all_roles', 'user_permissions', 'all_permissions'));
    }

    public function assignRoles(Request $request, User $user){

        if($user->hasRole($request->role)){
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->role);
        return redirect()->route('admin.users.roles.show', $user->id);
    }

    public function assignPermissions(Request $request, User $user){
        if($user->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists');
        }
        $user->givePermissionTo($request->permission);
        return redirect()->route('admin.users.permissions.show', $user->id);
    }

    public function showPermissions(User $user){
        $permissions = $user->permissions;
        return view('admin.users.permissions', compact('user', 'permissions'));
    }

    public function removePermissions(User $user, Permission $permission){
        if($user->hasPermissionTo($permission)){
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission do not exists.');

    }
}
