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

    public function create(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('role', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3'], 'permissions' => ['nullable', 'array'] ]);
        $roles = Role::create($validated);
        if (!empty($validated['permissions'])) {
            $roles->syncPermissions($validated['permissions']);
        }
        
        return to_route('admin.roles.index')->with('message', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));

    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'permissions' => ['array', 'nullable'],
        ]);

        $role->update(['name' => $validated['name']]);

        if (isset($validated['permissions']) && !empty($validated['permissions'])) {
            // Sync the provided permissions
            $permissions = Permission::whereIn('name', $validated['permissions'])->get();
            $role->syncPermissions($permissions);
        } else {
            // Remove all permissions if none are selected
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles.index')->with('message', 'Role updated successfully');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message', 'Role deleted successfully');
    }

}
