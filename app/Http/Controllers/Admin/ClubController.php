<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;

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
        $validated = $request->validate(['name' => ['required', 'min:3'], 'manager_id' => ['nullable', 'array'] ]);
        Club::create($validated);

        return to_route('admin.clubs')->with('message', 'Club created successfully');
    }
}
