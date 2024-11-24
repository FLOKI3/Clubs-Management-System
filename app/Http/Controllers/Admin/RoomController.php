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
    
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $user = Auth::user();
        
        // If the user is a manager, fetch their club
        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            // Managers can only create rooms for their assigned club
            return view('admin.rooms.create', compact('club'));
        }

        // Admins can select from all clubs
        $clubs = Club::all();
        return view('admin.rooms.create', compact('clubs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validation rules
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'club_id' => ['required', 'exists:clubs,id'], // Ensure club exists
        ]);

        // If the user is a manager, ensure they are creating for their own club
        if ($user->club) {
            if ($user->club->id !== (int) $validated['club_id']) {
                return redirect()->back()->with('error', 'You can only create rooms for your assigned club.');
            }
        }

        // Create the room
        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('message', 'Room created successfully!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return back()->with('message', 'Room deleted successfully');
    }
}
