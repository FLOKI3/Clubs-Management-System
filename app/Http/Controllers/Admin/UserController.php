<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    if ($user->hasRole('manager') && $user->club_id) {
        $users = User::where('club_id', $user->club_id)->get();
    } else {
        $users = User::with('club')->get();
    }
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles= Role::all();
        $permissions= Permission::all();
        $clubs = Club::all();

        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'clubs'));
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
            'club_id' => ['nullable', 'exists:clubs,id'], 
            'role' => ['nullable', 'in:manager,coach'], 
        ]);

        $user->update([
            'name' => $validatedData['name'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'club_id' => $validatedData['club_id'] ?? $user->club_id, 
        ]);

        if (isset($validatedData['roles']) && !empty($validatedData['roles'])) {
            $roles = Role::whereIn('name', $validatedData['roles'])->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        if (isset($validatedData['role']) && $validatedData['role']) {
            $user->syncRoles([$validatedData['role']]);
        }

        if ($request->hasFile('profile_picture')) {
            $user->clearMediaCollection('profile_pictures');
            $user->addMediaFromRequest('profile_picture')->toMediaCollection('profile_pictures');
        }

        return redirect()->route('admin.users.index')->with('message', 'User profile updated successfully.');
    }


    public function create()
    {
        $clubs = Club::all();
        return view('admin.users.create', compact('clubs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'club_id' => ['nullable', 'exists:clubs,id'], 
            'role' => ['nullable', 'in:manager,coach'], 
        ]);

        $user = User::create([
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'club_id' => $request->club_id,
        ]);

        $user->assignRole($request->role);

        if ($user->hasRole('manager') && $user->club) {
            $validated['club_id'] = $user->club->id;
        }

        event(new Registered($user));

        return redirect(route('admin.users.index', absolute: false));
    }
}
