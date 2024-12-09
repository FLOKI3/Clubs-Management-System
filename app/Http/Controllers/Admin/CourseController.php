<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 

        // Check if the user is a manager assigned to a club
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        if ($club) {
            // If the user is a manager, show courses for their club
            $courses = Course::where('club_id', $club->id)->get();
        } elseif ($user->hasRole('coach')) {
            // If the user is a coach, show courses they are assigned to
            $courses = Course::where('coach_id', $user->id)->get();
        } else {
            // For admins or other roles, show all courses
            $courses = Course::all();
        }

        return view('admin.courses.index', compact('courses', 'club'));
    }

    public function create()
    {
        $user = Auth::user(); 
        // Check if the logged-in user is a manager of a club
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        if (!$club) {
            return redirect()->route('admin.courses.index')->with('message', 'Only manager can create courses.');
        }

        $lessons = Lesson::where('club_id', $club->id)->get();
        $rooms = Room::where('club_id', $club->id)->get();
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'coach');
        })->whereHas('club', function ($query) use ($club) {
            $query->where('id', $club->id);
        })->get(); 

        return view('admin.courses.create', compact('club', 'users', 'lessons', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'club_id' => 'required|exists:clubs,id',
            'coach_id' => 'required|exists:users,id',
            'lesson_id' => 'required|exists:lessons,id',
            'room_id' => 'required|exists:rooms,id',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after:startTime',
        ]);

        $user = Auth::user();

        // Ensure the user is a manager of the club
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->where('id', $request->club_id)->first();

        if (!$club) {
            return redirect()->back()->with('error', 'You can only create courses for your assigned club.');
        }

        // Ensure selected lesson and room belong to the club
        $lesson = Lesson::where('id', $request->lesson_id)->where('club_id', $club->id)->first();
        $room = Room::where('id', $request->room_id)->where('club_id', $club->id)->first();

        if (!$lesson || !$room) {
            return redirect()->back()->with('error', 'Lesson or room is not valid for the selected club.');
        }

        // Ensure selected coach has a coach role in the club
        $coach = User::whereHas('roles', function ($query) {
            $query->where('name', 'coach');
        })->whereHas('club', function ($query) use ($club) {
            $query->where('id', $club->id);
        })->find($request->coach_id);

        if (!$coach) {
            return redirect()->back()->with('error', 'Selected coach is not valid for the selected club.');
        }

        // Create the course
        Course::create([
            'club_id' => $club->id,
            'lesson_id' => $lesson->id,
            'room_id' => $room->id,
            'coach_id' => $coach->id,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);

        return redirect()->route('admin.courses.index')->with('message', 'Course created successfully.');
    }

    public function destroy($id)
    {
        $course = Course::find($id);

        // Delete the course
        $course->delete();

        return redirect()->route('admin.courses.index')->with('message', 'Course deleted successfully.');
    }

    public function edit($id)
    {
        // Find the course by ID
        $course = Course::findOrFail($id);

        // Fetch the currently authenticated user
        $user = Auth::user();

        // Check if the logged-in user is a manager of a club
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        // If the user does not belong to any club, show a message
        if (!$club) {
            return redirect()->route('admin.courses.index')->with('message', 'Only manager can edit courses.');
        }

        // Restrict lessons and rooms to the manager's club
        $lessons = Lesson::where('club_id', $club->id)->get();
        $rooms = Room::where('club_id', $club->id)->get();

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'coach');
        })->whereHas('club', function ($query) use ($club) {
            $query->where('id', $club->id);
        })->get(); 

        return view('admin.courses.edit', compact('course', 'lessons', 'rooms', 'users', 'club'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'room_id' => 'required|exists:rooms,id',
            'coach_id' => 'required|exists:users,id',
            'startTime' => 'required|date',
            'endTime' => 'required|date|after:startTime',
        ]);

        // Find the course by ID
        $course = Course::findOrFail($id);

        // Get the associated club for the course
        $club = $course->club;

        if (!$club) {
            return redirect()->back()->with('error', 'Associated club is invalid.');
        }

        // Update the course details
        $course->update([
            'lesson_id' => $request->lesson_id,
            'room_id' => $request->room_id,
            'coach_id' => $request->coach_id,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);

        return redirect()->route('admin.courses.index')->with('message', 'Course updated successfully.');
    }
}
