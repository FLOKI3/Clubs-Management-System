<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::with('manager')->get();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function create()
    {
        $users = User::all();
        $clubs = Club::all();
        return view('admin.clubs.create', compact('clubs', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3'],
            'manager_id' => ['required', 'exists:users,id']
        ]);

        // Create the club
        $club = Club::create($validated);

        // Dynamically assign the "manager" role to the manager
        $manager = User::find($validated['manager_id']);
        if ($manager) {
            // Create a unique role for the manager based on the club's ID or name
            $roleName = 'manager_of_club_' . $club->name; // Use club name or ID here

            // Assign the role to the manager
            $manager->assignRole($roleName);
        }

        // Redirect to the club index with success message
        return to_route('admin.clubs.index')->with('message', 'Club created successfully');
    }

    
    public function destroy(Club $club)
    {
        $club->delete();
        return back()->with('message', 'Club deleted successfully');
    }

}