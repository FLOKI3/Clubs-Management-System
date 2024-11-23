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
    
}
