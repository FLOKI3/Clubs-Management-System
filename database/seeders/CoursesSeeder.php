<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all clubs
        $clubs = Club::all();

        foreach ($clubs as $club) {
            // Get related lessons, rooms, and coaches for the club
            $lessons = Lesson::where('club_id', $club->id)->get();
            $rooms = Room::where('club_id', $club->id)->get();
            $coaches = User::role('coach')->get();

            // Create 5 random courses for each club
            for ($i = 0; $i < 5; $i++) {
                $lesson = $lessons->random();
                $room = $rooms->random();
                $coach = $coaches->random();

                // Generate random start time and end time
                $startTime = Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), 0, 0);
                $endTime = $startTime->copy()->addHours(rand(1, 3));

                // Create course
                Course::create([
                    'club_id' => $club->id,
                    'coach_id' => $coach->id,
                    'lesson_id' => $lesson->id,
                    'room_id' => $room->id,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                ]);
            }
        }
    }
    
}
