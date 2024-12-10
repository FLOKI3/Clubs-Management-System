<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClubRequest;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class ClubController extends Controller
{
    public function create()
    {
        return view('admin.clubs.create');
    }

    public function store(ClubRequest $request)
    {
        $validated = $request->validated();

        $club = Club::create($validated);


        return redirect()->route('admin.clubs.index')->with('message', 'Club created successfully!');
    }

    public function index()
    {
        $clubs = Club::with('users')->get(); 
        $managers = $clubs->mapWithKeys(function ($club) {
            $managers = $club->users()->whereHas('roles', function ($query) {
                $query->where('name', 'manager');
            })->get();

            return [$club->id => $managers];
        });
        return view('admin.clubs.index', compact('clubs', 'managers'));
    }

    public function destroy(Club $club)
    {
        $users = $club->users;

        foreach ($users as $user) {
            if ($user->hasRole('manager')) {
                $user->removeRole('manager');
            }

            $user->update(['club_id' => null]);
        }

        $club->delete();

        return back()->with('message', 'Club and associated roles deleted successfully');
    }


    public function edit(Club $club)
    {
        return view('admin.clubs.edit', compact('club'));
    }

    public function update(ClubRequest $request, Club $club)
    {
        $validated = $request->validated();

        $club->update([
            'name' => $validated['name'],
        ]);

        
        if ($request->hasFile('clubs_logo')) {
            $club->clearMediaCollection('clubs_logo');
            $club->addMediaFromRequest('clubs_logo')->toMediaCollection('clubs_logo');
        }

        return redirect()->route('admin.clubs.index')->with('message', 'Club updated successfully!');
    }

}
