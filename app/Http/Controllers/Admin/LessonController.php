<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $club = Club::where('manager_id', $user->id)->first();
    
        if ($club) {
            $lessons = $club->lessons;
        } else {
            $lessons = Lesson::all();
        }
    
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            return view('admin.lessons.create', compact('club'));
        }

        $clubs = Club::all();
        return view('admin.lessons.create', compact('clubs'));
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
                return redirect()->back()->with('error', 'You can only create lessons for your assigned club.');
            }
        }

        Lesson::create($validated);

        return redirect()->route('admin.lessons.index')->with('message', 'Lesson created successfully!');
    }

    public function edit(Lesson $lesson)
    {
        $user = Auth::user();

        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            if ($lesson->club_id !== $club->id) {
                return redirect()->route('admin.lessons.index')->with('error', 'You can only edit lessons in your assigned club.');
            }

            return view('admin.lessons.edit', compact('lesson', 'club'));
        }

        $clubs = Club::all();
        return view('admin.lessons.edit', compact('lesson', 'clubs'));
    }


    public function update(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'club_id' => ['required', 'exists:clubs,id'],
        ]);

        if ($user->club) {
            if ($user->club->id !== (int) $validated['club_id']) {
                return redirect()->back()->with('error', 'You can only create lessons for your assigned club.');
            }
        }

        $lesson->update($validated);

        return redirect()->route('admin.lessons.index')->with('message', 'Lesson created successfully!');
    }


    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('message', 'Lesson deleted successfully');
    }

}
