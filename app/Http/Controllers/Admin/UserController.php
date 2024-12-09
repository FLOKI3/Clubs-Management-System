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
        // If the logged-in user is a manager, show only users assigned to their club
        $users = User::where('club_id', $user->club_id)->get();
    } else {
        // For other roles (e.g., admin), show all users
        $users = User::with('club')->get();
    }
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $roles= Role::all();
        $permissions= Permission::all();
        $clubs = Club::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions', 'clubs'));
    }

    

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('message', 'User deleted successfully');
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => ['array', 'nullable'],
            'club_id' => ['nullable', 'exists:clubs,id'], // Validate club selection
            'role' => ['nullable', 'in:manager,coach'], // Ensure valid role selection
        ]);

        // Update the user's data
        $user->update([
            'name' => $validatedData['name'],
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone_number' => $validatedData['phone_number'],
            'email' => $validatedData['email'],
            'club_id' => $validatedData['club_id'] ?? $user->club_id, // Only update if club_id is provided
        ]);

        // Sync roles if they exist in the request
        if (isset($validatedData['roles']) && !empty($validatedData['roles'])) {
            $roles = Role::whereIn('name', $validatedData['roles'])->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        // Assign the new role if provided in the request
        if (isset($validatedData['role']) && $validatedData['role']) {
            $user->syncRoles([$validatedData['role']]);
        }

        // Handle profile picture update if provided
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

        // Auto-assign club_id if the user is a manager
        if ($user->hasRole('manager') && $user->club) {
            $validated['club_id'] = $user->club->id;
        }

        event(new Registered($user));

        return redirect(route('admin.users.index', absolute: false));
    }
}
