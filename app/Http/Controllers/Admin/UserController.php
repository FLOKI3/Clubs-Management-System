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

    

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }

    public function update(Request $request, User $user)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => ['array', 'nullable'],
        ]);

        $user->update($validatedData);

        if (isset($validatedData['roles']) && !empty($validatedData['roles'])) {
            $roles = Role::whereIn('name', $validatedData['roles'])->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

            if ($request->hasFile('profile_picture')) {
                $user->clearMediaCollection('profile_pictures');
                $user->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');
            }

        return redirect()->route('admin.users.index')->with('message', 'User profile updated successfully.');
    }

    
}
