<?php

namespace Database\Seeders;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Club 1 - Fitness Club
            [
                'club_id' => 1,
                'coach_id' => 2, // Bob Smith
                'lesson_id' => 1,
                'room_id' => 1,
                'startTime' => Carbon::now()->addDays(1)->setTime(9, 0),
                'endTime' => Carbon::now()->addDays(1)->setTime(10, 30),
            ],
            [
                'club_id' => 1,
                'coach_id' => 3, // Carol Lee
                'lesson_id' => 2,
                'room_id' => 2,
                'startTime' => Carbon::now()->addDays(2)->setTime(11, 0),
                'endTime' => Carbon::now()->addDays(2)->setTime(12, 30),
            ],
            // Club 2 - Sports Club
            [
                'club_id' => 2,
                'coach_id' => 5, // Evelyn Davis
                'lesson_id' => 3,
                'room_id' => 3,
                'startTime' => Carbon::now()->addDays(3)->setTime(14, 0),
                'endTime' => Carbon::now()->addDays(3)->setTime(15, 30),
            ],
            [
                'club_id' => 2,
                'coach_id' => 6, // Franklin Wilson
                'lesson_id' => 4,
                'room_id' => 4,
                'startTime' => Carbon::now()->addDays(4)->setTime(16, 0),
                'endTime' => Carbon::now()->addDays(4)->setTime(17, 30),
            ],
            // Club 3 - Yoga Club
            [
                'club_id' => 3,
                'coach_id' => 8, // Henry Martin
                'lesson_id' => 5,
                'room_id' => 5,
                'startTime' => Carbon::now()->addDays(5)->setTime(10, 0),
                'endTime' => Carbon::now()->addDays(5)->setTime(11, 30),
            ],
            // Club 4 - Martial Arts Club
            [
                'club_id' => 4,
                'coach_id' => 10, // James Davis
                'lesson_id' => 6,
                'room_id' => 6,
                'startTime' => Carbon::now()->addDays(6)->setTime(9, 0),
                'endTime' => Carbon::now()->addDays(6)->setTime(10, 30),
            ],
            [
                'club_id' => 4,
                'coach_id' => 11, // Karen Wright
                'lesson_id' => 7,
                'room_id' => 7,
                'startTime' => Carbon::now()->addDays(7)->setTime(12, 0),
                'endTime' => Carbon::now()->addDays(7)->setTime(13, 30),
            ],
            // Club 5 - Music Club
            [
                'club_id' => 5,
                'coach_id' => 13, // Mark Lee
                'lesson_id' => 8,
                'room_id' => 8,
                'startTime' => Carbon::now()->addDays(8)->setTime(15, 0),
                'endTime' => Carbon::now()->addDays(8)->setTime(16, 30),
            ],
            [
                'club_id' => 5,
                'coach_id' => 14, // Nancy King
                'lesson_id' => 9,
                'room_id' => 9,
                'startTime' => Carbon::now()->addDays(9)->setTime(17, 0),
                'endTime' => Carbon::now()->addDays(9)->setTime(18, 30),
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
