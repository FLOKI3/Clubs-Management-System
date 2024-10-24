<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles= Role::all();
        $permissions= Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        if ($user->name === 'admin') {
            return back()->with('message', 'You cannot edit this user.');
        }
        if($user->hasRole($request->role)){
            return back()->with('message', 'Role exists');
        }
        $user->assignRole($request->role);
        return back()->with('message', 'Role assigned successfully');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->name === 'admin') {
            return back()->with('message', 'You cannot remove roles from the admin user.');
        }
        if($user->hasRole($role)){
            $user->removeRole($role);
            return back()->with('message', 'Role removed successfully');
        }
        return back()->with('message', 'Role not exists');
    }
    
}
