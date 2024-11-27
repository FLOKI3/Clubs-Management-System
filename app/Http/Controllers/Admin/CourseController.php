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
        $club = Club::where('manager_id', $user->id)->first();

        if ($club) {
            $courses = Course::where('club_id', $club->id)->get();
            return view('admin.courses.index', compact('courses', 'club'));
        }
        $courses = Course::all();

        return view('admin.courses.index', compact('courses', 'club'));
    }

    
    public function create()
{
    $user = Auth::user(); // Get the logged-in user
    $club = Club::where('manager_id', $user->id)->first(); // Find the club associated with the logged-in user

    // Check if the user has a club assigned
    if (!$club) {
        return redirect()->route('admin.courses.index')->with('message', 'Only manager create courses.');
    }

    // If the user has a club, filter lessons and rooms specific to that club
    $lessons = Lesson::where('club_id', $club->id)->get();
    $rooms = Room::where('club_id', $club->id)->get();
    $users = User::all(); // Get all users

    return view('admin.courses.create', compact('club', 'users', 'lessons', 'rooms'));
}


    public function store(Request $request)
{
    $request->validate([
        'club_id' => 'required|exists:clubs,id', // Ensure a valid club is selected
        'lesson_id' => 'required|exists:lessons,id',
        'room_id' => 'required|exists:rooms,id',
        'coach_id' => 'required|exists:users,id',
        'startTime' => 'required|date',
        'endTime' => 'required|date|after:startTime',
    ]);

    // Retrieve the selected coach user
    $coach = User::find($request->coach_id);

    // Retrieve the club from the request
    $club = Club::find($request->club_id);

    if (!$club) {
        return redirect()->back()->with('error', 'Selected club is invalid.');
    }

    // Generate role name based on the selected club's name
    $roleName = 'coach_of_' . strtolower(str_replace(' ', '_', $club->name));

    // Assign the coach role if the user does not already have it
    if (!$coach->hasRole($roleName)) {
        $role = Role::findOrCreate($roleName);
        $coach->assignRole($role);
    }

    // Create the course
    Course::create([
        'club_id' => $club->id,
        'lesson_id' => $request->lesson_id,
        'room_id' => $request->room_id,
        'coach_id' => $request->coach_id,
        'startTime' => $request->startTime,
        'endTime' => $request->endTime,
        'guard_name' => 'web', // Ensure the guard_name is set
    ]);

    return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
}

public function destroy($id)
{
    $course = Course::find($id);

    if (!$course) {
        return redirect()->route('admin.courses.index')->with('error', 'Course not found.');
    }

    $course->delete();

    return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
}

public function edit($id)
{
    // Find the course by ID
    $course = Course::findOrFail($id);

    // Fetch the currently authenticated user
    $user = Auth::user();

    // Check if the user is assigned to a club
    $club = Club::where('manager_id', $user->id)->first();

    // If the user does not belong to any club, show a message
    if (!$club) {
        return redirect()->route('admin.courses.index')->with('message', 'Only manager can edit courses.');
    }

    // Restrict lessons and rooms to the manager's club
    $lessons = Lesson::where('club_id', $club->id)->get();
    $rooms = Room::where('club_id', $club->id)->get();

    // Fetch all users (or filter as needed)
    $users = User::all();

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

    // Update the course details
    $course->update([
        'lesson_id' => $request->lesson_id,
        'room_id' => $request->room_id,
        'coach_id' => $request->coach_id,
        'startTime' => $request->startTime,
        'endTime' => $request->endTime,
    ]);

    return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
}

}
