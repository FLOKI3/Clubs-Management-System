<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $club = Club::where('manager_id', $user->id)->first();
    
        if ($club) {
            $rooms = $club->rooms;
        } else {
            $rooms = Room::all();
        }

        foreach ($rooms as $room) {
            $activeCourse = $room->courses()
                ->where('startTime', '<=', now())
                ->where('endTime', '>=', now())
                ->exists();
            
            $room->status = $activeCourse ? 'active' : 'inactive';
        }
    
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            return view('admin.rooms.create', compact('club'));
        }

        $clubs = Club::all();
        return view('admin.rooms.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'club_id' => ['required', 'exists:clubs,id'],
        ]);

        if ($user->club) {
            if ($user->club->id !== (int) $validated['club_id']) {
                return redirect()->back()->with('error', 'You can only create rooms for your assigned club.');
            }
        }

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('message', 'Room created successfully!');
    }

    public function edit(Room $room)
    {
        $user = Auth::user();

        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            if ($room->club_id !== $club->id) {
                return redirect()->route('admin.rooms.index')->with('error', 'You can only edit rooms in your assigned club.');
            }

            return view('admin.rooms.edit', compact('room', 'club'));
        }

        $clubs = Club::all();
        return view('admin.rooms.edit', compact('room', 'clubs'));
    }


    public function update(Request $request, Room $room)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'club_id' => ['required', 'exists:clubs,id'],
        ]);

        if ($user->club) {
            if ($user->club->id !== (int) $validated['club_id']) {
                return redirect()->back()->with('error', 'You can only create rooms for your assigned club.');
            }
        }

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('message', 'Room created successfully!');
    }


    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('message', 'Room deleted successfully');
    }
}
