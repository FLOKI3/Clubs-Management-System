<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class ClubController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('admin.clubs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'club_name' => ['required', 'string', 'min:3'],
            'manager_id' => ['required', 'exists:users,id'],
            'guard_name' => ['required', 'string', 'min:3'],
        ]);

        $club = Club::create([
            'name' => $validated['club_name'],
            'manager_id' => $validated['manager_id'],
            'guard_name' => $validated['guard_name'],
        ]);

        $manager = User::findOrFail($validated['manager_id']);
        $roleName = $validated['guard_name'];

        Role::findOrCreate($roleName);
        $manager->assignRole($roleName); 
        $manager->assignRole('manager'); 

        return redirect()->route('admin.clubs.index')->with('message', 'Club created successfully!');
    }

    public function index()
    {
        $clubs = Club::with('manager')->get();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function destroy(Club $club)
    {
        $roleName = $club->guard_name; 
        $manager = $club->manager; 

        if ($manager) {
            if ($manager->hasRole($roleName)) {
                $manager->removeRole($roleName); 
            }
            if ($manager->hasRole('manager')) {
                $manager->removeRole('manager');
            }
        }

        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $role->delete(); 
        }

        $club->delete();

        return back()->with('message', 'Club and associated roles deleted successfully');
    }


    public function edit(Club $club)
    {
        $managers = User::all();
        return view('admin.clubs.edit', compact('club', 'managers'));
    }

    public function update(Request $request, Club $club)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'manager_id' => ['required', 'exists:users,id'],
        ]);

        $roleName = $club->guard_name; 
        $oldManager = $club->manager;  

        $club->update([
            'name' => $validated['name'],
            'manager_id' => $validated['manager_id'],
        ]);

        if ($oldManager && $oldManager->id !== $validated['manager_id']) {
            $otherManagedClubs = Club::where('manager_id', $oldManager->id)->exists();

            if (!$otherManagedClubs) {
                $oldManager->removeRole('manager'); 
            }

            $oldManager->removeRole($roleName);
        }

        $newManager = User::findOrFail($validated['manager_id']);
        if (!$newManager->hasRole($roleName)) {
            $newManager->assignRole($roleName); 
        }
        if (!$newManager->hasRole('manager')) {
            $newManager->assignRole('manager'); 
        }

        if ($request->hasFile('clubs_logo')) {
            $club->clearMediaCollection('clubs_logo');
            $club->addMediaFromRequest('clubs_logo')->toMediaCollection('clubs_logo');
        }

        return redirect()->route('admin.clubs.index')->with('message', 'Club updated successfully!');
    }

}
