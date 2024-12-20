<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\User;
use App\Models\Room;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TestDataSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $club = Club::create([
            'name' => 'Club de Fitness Devaga',
        ]);

        User::create([
            'name' => 'Super Admin',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'phone_number' => '+1234567890',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'devaga club',
            'first_name' => 'devaga',
            'last_name' => 'club',
            'phone_number' => '+1234567890',
            'email' => 'club@devaga.com',
            'club_id' => $club->id,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');

        $rooms = [
            'Salle Principale',
            'Salle de Yoga',
            'Salle de Cardio',
            'Salle de Musculation',
            'Piscine',
        ];

        foreach ($rooms as $roomName) {
            $club->rooms()->create([
                'name' => $roomName,
            ]);
        }

        $lessons = [
            'Bases du Yoga',
            'Yoga Avancé',
            'Cardio Débutant',
            'Cardio Intermédiaire',
            'Musculation 101',
            'Musculation Avancée',
            'Techniques de Natation',
            'Fitness Aquatique',
            'Pilates pour Débutants',
            'Pilates Avancé',
        ];

        foreach ($lessons as $lessonName) {
            $slug = Str::slug($lessonName);
            $lesson = $club->lessons()->create([
                'name' => $lessonName,
            ]);

            $logoPath = public_path("assets/lessons/{$slug}.png");
            if (file_exists($logoPath)) {
                $lesson->addMedia($logoPath)
                    ->preservingOriginal()
                    ->toMediaCollection('lessons_logo');
            }
        }

        $coaches = [
            ['first_name' => 'Ahmed', 'last_name' => 'Bennani', 'email' => 'ahmed.bennani@gmail.com'],
            ['first_name' => 'Hind', 'last_name' => 'El Mansouri', 'email' => 'hind.elmansouri@gmail.com'],
            ['first_name' => 'Rachid', 'last_name' => 'El Fassi', 'email' => 'rachid.elfassi@gmail.com'],
            ['first_name' => 'Karima', 'last_name' => 'Amrani', 'email' => 'karima.amrani@gmail.com'],
            ['first_name' => 'Mohamed', 'last_name' => 'Alaoui', 'email' => 'mohamed.alaoui@gmail.com'],
            ['first_name' => 'Fatima', 'last_name' => 'Zahra', 'email' => 'fatima.zahra@gmail.com'],
            ['first_name' => 'Youssef', 'last_name' => 'Haddadi', 'email' => 'youssef.haddadi@gmail.com'],
            ['first_name' => 'Salma', 'last_name' => 'Bouhriz', 'email' => 'salma.bouhriz@gmail.com'],
        ];

        foreach ($coaches as $coach) {
            $club->users()->create([
                'name' => $coach['first_name'] . ' ' . $coach['last_name'],
                'first_name' => $coach['first_name'],
                'last_name' => $coach['last_name'],
                'phone_number' => '+1234567890',
                'email' => $coach['email'],
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password'),
            ])->assignRole('coach');
        }

        // Add Courses for 31 Days
        $lessonsList = $club->lessons;
        $roomsList = $club->rooms;
        $coachesList = $club->users()->role('coach')->get();
        $currentDate = Carbon::now()->startOfWeek();

        for ($day = 0; $day < 31; $day++) {
            $currentDay = $currentDate->copy()->addDays($day);
            $startTime = match ($currentDay->englishDayOfWeek) {
                'Saturday' => $currentDay->setTime(10, 0),
                'Sunday' => $currentDay->setTime(10, 0),
                default => $currentDay->setTime(8, 0),
            };

            $endOfDay = match ($currentDay->englishDayOfWeek) {
                'Saturday' => $currentDay->copy()->setTime(18, 0),
                'Sunday' => $currentDay->copy()->setTime(14, 0),
                default => $currentDay->copy()->setTime(21, 0),
            };

            while ($startTime->lt($endOfDay)) {
                $lesson = $lessonsList->random();
                $room = $roomsList->random();
                $coach = $coachesList->random();
                $courseDuration = rand(60, 90);

                $courseEndTime = $startTime->copy()->addMinutes($courseDuration);

                if ($courseEndTime->lte($endOfDay)) {
                    Course::create([
                        'club_id' => $club->id,
                        'coach_id' => $coach->id,
                        'lesson_id' => $lesson->id,
                        'room_id' => $room->id,
                        'startTime' => $startTime->minute(0)->toDateTimeString(),
                        'endTime' => $courseEndTime->minute(($courseEndTime->minute < 15 ? 0 : ($courseEndTime->minute < 30 ? 15 : ($courseEndTime->minute < 45 ? 30 : 45))))->toDateTimeString(),
                    ]);
                }

                $startTime = $courseEndTime->minute(($courseEndTime->minute < 15 ? 0 : ($courseEndTime->minute < 30 ? 15 : ($courseEndTime->minute < 45 ? 30 : 45))))->copy()->addMinutes(30); // 30 min break
            }
        }
    }
}
