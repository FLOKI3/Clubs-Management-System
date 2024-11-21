<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class ClubController extends Controller
{
    // Step 1: Display the "Create Role" form
    public function showStep1()
    {
        return view('admin.clubs.step1');
    }

    // Handle Step 1 submission
    public function processStep1(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
        ]);

        // Store data in the session
        Session::put('step1', ['role_name' => $validated['name']]);

        // Redirect to the next step
        return redirect()->route('admin.clubs.step2');
    }

    // Step 2: Display the "Create Club" form
    public function showStep2()
    {
        // Ensure Step 1 data is available
        if (!Session::has('step1')) {
            return redirect()->route('admin.clubs.step1')->with('error', 'Please complete Step 1 first.');
        }

        $step1 = Session::get('step1'); // Get the step 1 data from session
        $users = User::all();
        return view('admin.clubs.step2', compact('users', 'step1'));
    }

    // Handle Step 2 submission
    public function processStep2(Request $request)
    {
        $validated = $request->validate([
            'club_name' => ['required', 'string', 'min:3'],
            'manager_id' => ['required', 'exists:users,id'],
        ]);

        // Store club data in session
        Session::put('step2', $validated);
        return redirect()->route('admin.clubs.step3');
    }

    // Step 3: Display confirmation page
    public function showStep3()
    {
        // Ensure Step 1 and Step 2 data are available
        if (!Session::has('step1') || !Session::has('step2')) {
            return redirect()->route('admin.clubs.step1');
        }

        $step1 = Session::get('step1');
        $step2 = Session::get('step2');
        $manager = User::find($step2['manager_id']);

        return view('admin.clubs.step3', compact('step1', 'step2', 'manager'));
    }

    // Handle final submission
    public function submitAllSteps()
    {
        // Retrieve all session data
        $step1 = Session::get('step1');
        $step2 = Session::get('step2');

        // Create the club
        $club = Club::create([
            'name' => $step2['club_name'],
            'manager_id' => $step2['manager_id'],
        ]);

        // Create and assign the manager role
        $manager = User::find($step2['manager_id']);
        if ($manager) {
            $roleName = $step1['role_name'];
            Role::findOrCreate($roleName); // Ensure the role exists
            $manager->assignRole($roleName);
        }

        // Clear session data
        Session::forget(['step1', 'step2']);

        // Redirect to the club index with a success message
        return redirect()->route('admin.clubs.index')->with('message', 'Club created successfully!');
    }

    public function index()
    {
        $clubs = Club::with('manager')->get();
        return view('admin.clubs.index', compact('clubs'));
    }

    public function destroy(Club $club)
    {
        $club->delete();
        return back()->with('message', 'Club deleted successfully');
    }
}
