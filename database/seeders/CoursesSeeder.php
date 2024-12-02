<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clubs = Club::all();
        $coachIds1 = [5, 6, 7]; // First coach IDs
        $coachIds2 = [8, 9, 10]; // Second coach IDs

        // Loop through each club and assign two coaches
        foreach ($clubs as $index => $club) {
            $lessons = Lesson::where('club_id', $club->id)->get();
            $rooms = Room::where('club_id', $club->id)->get();

            // Get the first and second coaches for each club
            $coach1 = User::find($coachIds1[$index % count($coachIds1)]); // First coach
            $coach2 = User::find($coachIds2[$index % count($coachIds2)]); // Second coach

            // Assign roles to both coaches
            $roleName1 = 'coach_of_' . strtolower(str_replace(' ', '_', $club->name));
            $roleName2 = 'coach_of_' . strtolower(str_replace(' ', '_', $club->name)); // Role for second coach

            Role::findOrCreate($roleName1);
            Role::findOrCreate($roleName2);

            // Assign roles if not already assigned
            if (!$coach1->hasRole($roleName1)) {
                $coach1->assignRole($roleName1, 'coach');
            }
            if (!$coach2->hasRole($roleName2)) {
                $coach2->assignRole($roleName2, 'coach');
            }

            // Generate 4 courses for this club
            for ($i = 1; $i <= 4; $i++) {
                $startTime = now()->addDays(rand(1, 30))->setTime(rand(8, 17), 0); // Random time between 8 AM and 5 PM
                $duration = rand(1, 3) * 60; // Random duration between 1 and 3 hours (in minutes)
                $endTime = $startTime->copy()->addMinutes($duration);

                // Randomly assign one of the two coaches to the course
                $coach = rand(0, 1) ? $coach1 : $coach2;

                Course::create([
                    'club_id' => $club->id,
                    'coach_id' => $coach->id,
                    'guard_name' => 'web',
                    'lesson_id' => $lessons->random()->id,
                    'room_id' => $rooms->random()->id,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                ]);
            }
        }
    }
}
