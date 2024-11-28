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
    public function showStep1()
    {
        return view('admin.clubs.step1');
    }

    public function processStep1(Request $request)
    {
        $validated = $request->validate([
            'guard_name' => ['required', 'string', 'min:3'],
        ]);

        Session::put('step1', ['role_name' => $validated['guard_name']]);

        return redirect()->route('admin.clubs.step2');
    }

    public function showStep2()
    {
        if (!Session::has('step1')) {
            return redirect()->route('admin.clubs.step1')->with('error', 'Please complete Step 1 first.');
        }

        $step1 = Session::get('step1'); 
        $users = User::all();
        return view('admin.clubs.step2', compact('users', 'step1'));
    }

    public function processStep2(Request $request)
    {
        $validated = $request->validate([
            'club_name' => ['required', 'string', 'min:3'],
            'manager_id' => ['required', 'exists:users,id'],
        ]);

        Session::put('step2', $validated);
        return redirect()->route('admin.clubs.step3');
    }

    public function showStep3()
    {
        if (!Session::has('step1') || !Session::has('step2')) {
            return redirect()->route('admin.clubs.step1');
        }

        $step1 = Session::get('step1');
        $step2 = Session::get('step2');
        $manager = User::find($step2['manager_id']);

        return view('admin.clubs.step3', compact('step1', 'step2', 'manager'));
    }

    public function submitAllSteps()
    {
        $step1 = Session::get('step1');
        $step2 = Session::get('step2');

        $club = Club::create([
            'name' => $step2['club_name'],
            'manager_id' => $step2['manager_id'],
            'guard_name' => $step1['role_name']
        ]);

        $manager = User::find($step2['manager_id']);
        if ($manager) {
            $roleName = $step1['role_name'];
            Role::findOrCreate($roleName);
            $manager->assignRole($roleName, 'manager');
        }

        Session::forget(['step1', 'step2']);

        return redirect()->route('admin.clubs.index')->with('message', 'Club created successfully!');
    }

    public function index()
    {
        $clubs = Club::with('manager')->get();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function destroy(Club $club)
    {
        $roleName = $club->guard_name; // Dynamic role name
        $manager = $club->manager; // Current manager of the club

        // Remove roles from the manager
        if ($manager) {
            if ($manager->hasRole($roleName)) {
                $manager->removeRole($roleName); // Remove the dynamic role from the manager
            }
            if ($manager->hasRole('manager')) {
                $manager->removeRole('manager'); // Remove the 'manager' role from the manager
            }
        }

        // Delete the dynamic role from the database
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $role->delete(); // Delete the role itself
        }

        // Delete the club
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

        $roleName = $club->guard_name; // Dynamic role name
        $oldManager = $club->manager;  // Current manager before the update

        // Update club details
        $club->update([
            'name' => $validated['name'],
            'manager_id' => $validated['manager_id'],
        ]);

        // Remove roles from the old manager if they exist and are being replaced
        if ($oldManager && $oldManager->id !== $validated['manager_id']) {
            $oldManager->removeRole($roleName); // Remove the dynamic role
            $oldManager->removeRole('manager'); // Remove the 'manager' role
        }

        // Assign roles to the new manager
        $newManager = User::findOrFail($validated['manager_id']);
        if (!$newManager->hasRole($roleName)) {
            $newManager->assignRole($roleName); // Assign the dynamic role
        }
        if (!$newManager->hasRole('manager')) {
            $newManager->assignRole('manager'); // Assign the 'manager' role
        }

        return redirect()->route('admin.clubs.index')->with('message', 'Club updated successfully!');
    }

}
