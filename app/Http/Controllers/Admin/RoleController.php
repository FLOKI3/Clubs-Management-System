<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleController extends Controller
{

    public function index() 
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);
        return to_route('admin.roles.index')->with('message', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('message', 'You cannot edit the admin role.');
        }
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));

    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);
        return to_route('admin.roles.index')->with('message', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        if ($role->name === 'admin') {
            return back()->with('message', 'You cannot remove the admin role.');
        }
        $role->delete();
        return back()->with('message', 'Role deleted successfully');
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added successfully');
    }

    public function revokePermissionTo(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked');
        }
        return back()->with('message', 'Permission not exists');
    }
}
