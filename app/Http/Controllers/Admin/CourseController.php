<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Club;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class CourseController extends Controller
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
            $courses = Course::where('club_id', $club->id)->get();
        } elseif ($user->hasRole('coach')) {
            $courses = Course::where('coach_id', $user->id)->get();
        } else {
            $courses = Course::all();
        }

        return view('admin.courses.index', compact('courses', 'club'));
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

    public function store(CourseRequest $request)
    {
        $request->validated();

        $user = Auth::user();

        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->where('id', $request->club_id)->first();

        if (!$club) {
            return redirect()->back()->with('error', 'You can only create courses for your assigned club.');
        }

        $lesson = Lesson::where('id', $request->lesson_id)->where('club_id', $club->id)->first();
        $room = Room::where('id', $request->room_id)->where('club_id', $club->id)->first();

        if (!$lesson || !$room) {
            return redirect()->back()->with('error', 'Lesson or room is not valid for the selected club.');
        }

        $coach = User::whereHas('roles', function ($query) {
            $query->where('name', 'coach');
        })->whereHas('club', function ($query) use ($club) {
            $query->where('id', $club->id);
        })->find($request->coach_id);

        if (!$coach) {
            return redirect()->back()->with('error', 'Selected coach is not valid for the selected club.');
        }

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

        $course->delete();

        return redirect()->route('admin.courses.index')->with('message', 'Course deleted successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        $user = Auth::user();

        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                ->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('name', 'manager');
                });
        })->first();

        if (!$club) {
            return redirect()->route('admin.courses.index')->with('message', 'Only manager can edit courses.');
        }

        $lessons = Lesson::where('club_id', $club->id)->get();
        $rooms = Room::where('club_id', $club->id)->get();

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'coach');
        })->whereHas('club', function ($query) use ($club) {
            $query->where('id', $club->id);
        })->get(); 

        return view('admin.courses.edit', compact('course', 'lessons', 'rooms', 'users', 'club'));
    }

    public function update(CourseRequest $request, $id)
    {
        $request->validated();

        $course = Course::findOrFail($id);

        $club = $course->club;

        if (!$club) {
            return redirect()->back()->with('error', 'Associated club is invalid.');
        }

        $course->update([
            'lesson_id' => $request->lesson_id,
            'room_id' => $request->room_id,
            'coach_id' => $request->coach_id,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);

        return redirect()->route('admin.courses.index')->with('message', 'Course updated successfully.');
    }

    public function exportPdf()
    {
        $user = Auth::user();

    if ($user->hasRole('manager')) {
        $club = Club::whereHas('users', function ($query) use ($user) {
            $query->where('id', $user->id)
                  ->whereHas('roles', function ($roleQuery) {
                      $roleQuery->where('name', 'manager');
                  });
        })->first();

        if ($club) {
            $courses = Course::where('club_id', $club->id)
                ->whereBetween('startTime', [now()->startOfWeek(), now()->endOfWeek()])
                ->get();
        } else {
            return redirect()->route('admin.courses.index')->with('error', 'You are not assigned to any club.');
        }
    } elseif ($user->hasRole('coach')) {
        $courses = Course::where('coach_id', $user->id)
            ->whereBetween('startTime', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();
    } else {
        $courses = Course::whereBetween('startTime', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();
    }

    $hideClub = $user->hasRole('manager') || $user->hasRole('coach');

        $pdf = Pdf::loadView('admin.courses.pdf', compact('courses', 'hideClub'));
        return $pdf->download('week_courses.pdf');
    }
}
