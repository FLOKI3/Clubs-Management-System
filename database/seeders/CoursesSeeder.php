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
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            [
                'club_id' => 1,
                'coach_id' => 3, // Carol Lee
                'lesson_id' => 2,
                'room_id' => 2,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            // Club 2 - Sports Club
            [
                'club_id' => 2,
                'coach_id' => 5, // Evelyn Davis
                'lesson_id' => 3,
                'room_id' => 3,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            [
                'club_id' => 2,
                'coach_id' => 6, // Franklin Wilson
                'lesson_id' => 4,
                'room_id' => 4,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            // Club 3 - Yoga Club
            [
                'club_id' => 3,
                'coach_id' => 8, // Henry Martin
                'lesson_id' => 5,
                'room_id' => 5,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            // Club 4 - Martial Arts Club
            [
                'club_id' => 4,
                'coach_id' => 10, // James Davis
                'lesson_id' => 6,
                'room_id' => 6,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            [
                'club_id' => 4,
                'coach_id' => 11, // Karen Wright
                'lesson_id' => 7,
                'room_id' => 7,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            // Club 5 - Music Club
            [
                'club_id' => 5,
                'coach_id' => 13, // Mark Lee
                'lesson_id' => 8,
                'room_id' => 8,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {return $startTime->copy()->addHours(rand(1, 3));},
            ],
            [
                'club_id' => 5,
                'coach_id' => 14, // Nancy King
                'lesson_id' => 9,
                'room_id' => 9,
                'startTime' => Carbon::now()->addDays(rand(1, 30))->setTime(rand(8, 18), rand(0, 59), 0),
                'endTime' => function ($startTime) {
                    return $startTime->copy()->addHours(rand(1, 3));
                },
            ],
        ];

        foreach ($courses as &$course) {
            $startTime = Carbon::now()
                ->addDays(rand(1, 30))
                ->setTime(rand(8, 18), rand(0, 59), 0);
            $course['startTime'] = $startTime;
            $course['endTime'] = $startTime->copy()->addHours(rand(1, 3));
        }

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
