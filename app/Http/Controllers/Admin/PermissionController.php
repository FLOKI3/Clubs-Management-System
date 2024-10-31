<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() 
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3'], 'roles' => ['nullable', 'array'],]);
        
        if (Permission::where('name', $validated['name'])->where('guard_name', 'web')->exists()) {
            return back()->withErrors(['name' => "A permission '{$validated['name']}' already exists"]);
        }
        
        $permissions = Permission::create($validated);
        if (!empty($validated['roles'])) {
            foreach ($validated['roles'] as $roleName) {
                $role = Role::where('name', $roleName)->first();
                $role->givePermissionTo($permissions);
            }
        }
        return to_route('admin.permissions.index')->with('message', 'Permission created successfully');
    }

    public function edit(Permission $permission)
    {
        $roles = Role::get();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'roles' => ['array', 'nullable'],
        ]);

        $existingPermission = Permission::where('name', $validated['name'])
        ->where('guard_name', 'web')
        ->first();

        if ($existingPermission && $existingPermission->id !== $permission->id) {
            return back()->withErrors(['name' => "A permission '{$validated['name']}' already exists."]);
        }

        $permission->update(['name' => $validated['name']]);

        if (isset($validated['roles']) && !empty($validated['roles'])) {
            $roles = Role::whereIn('name', $validated['roles'])->get();
            $permission->syncRoles($roles);
        } else {
            $permission->syncRoles([]);
        }

        return redirect()->route('admin.permissions.index')->with('message', 'Permission updated successfully');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return back()->with('message', 'Permission deleted successfully');
    }

    
    
}
