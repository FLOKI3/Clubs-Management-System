<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function destroy(User $user)
    {
        if ($user->name === 'admin') {
            return back()->with('message', 'You cannot delete the admin user.');
        }

        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }

    public function update(Request $request, User $user)
{

    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update($validatedData);

    return redirect()->route('admin.users.index')->with('message', 'User profile updated successfully.');
}

    
}
