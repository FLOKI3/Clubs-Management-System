<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Club;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();
    
        if ($club) {
            $lessons = $club->lessons;
        } else {
            $lessons = Lesson::all();
        }

        foreach ($lessons as $lesson) {
            $activeCourse = $lesson->courses()
                ->where('startTime', '<=', now())
                ->where('endTime', '>=', now())
                ->exists();
            
            $lesson->status = $activeCourse ? 'active' : 'inactive';
        }
    
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $user = Auth::user();
        
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        if ($club) {
            return view('admin.lessons.create', compact('club'));
        }

        $clubs = Club::all();
        return view('admin.lessons.create', compact('clubs'));
    }

    public function store(LessonRequest $request)
    {
        
        $validated = $request->validated();

        $lesson = Lesson::create($validated);

        if ($request->hasFile('lessons_logo')) {
            $lesson->addMediaFromRequest('lessons_logo')->toMediaCollection('lessons_logo');
        }

        return redirect()->route('admin.lessons.index')->with('message', 'Lesson created successfully!');
    }

    public function edit(Lesson $lesson)
    {
        $user = Auth::user();

        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        if ($club) {
            if ($lesson->club_id !== $club->id) {
                return redirect()->route('admin.lessons.index')->with('error', 'You can only edit lessons in your assigned club.');
            }

            return view('admin.lessons.edit', compact('lesson', 'club'));
        }

        $clubs = Club::all();
        return view('admin.lessons.edit', compact('lesson', 'clubs'));
    }


    public function update(LessonRequest $request, Lesson $lesson)
    {
        $user = Auth::user();
        
        $validated = $request->validated();

        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        $lesson->update($validated);

        if ($request->hasFile('lessons_logo')) {
            $lesson->clearMediaCollection('lessons_logo');
            $lesson->addMediaFromRequest('lessons_logo')->toMediaCollection('lessons_logo');
        }

        return redirect()->route('admin.lessons.index')->with('message', 'Lesson updated successfully!');
    }


    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back()->with('message', 'Lesson deleted successfully');
    }

}
