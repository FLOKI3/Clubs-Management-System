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
}
