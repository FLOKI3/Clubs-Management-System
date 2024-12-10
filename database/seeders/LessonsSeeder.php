<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Lesson::create([
            'name' => 'Strength Training',
            'club_id' => 1,
        ]);
        Lesson::create([
            'name' => 'Cardio',
            'club_id' => 1,
        ]);
        Lesson::create([
            'name' => 'Yoga for Fitness',
            'club_id' => 1,
        ]);
        Lesson::create([
            'name' => 'HIIT',
            'club_id' => 1,
        ]);
        Lesson::create([
            'name' => 'CrossFit',
            'club_id' => 1,
        ]);
        Lesson::create([
            'name' => 'Basketball Training',
            'club_id' => 2,
        ]);
        Lesson::create([
            'name' => 'Football Practice',
            'club_id' => 2,
        ]);
        Lesson::create([
            'name' => 'Tennis Training',
            'club_id' => 2,
        ]);
        Lesson::create([
            'name' => 'Swimming Practice',
            'club_id' => 2,
        ]);
        Lesson::create([
            'name' => 'Track & Field',
            'club_id' => 2,
        ]);
        Lesson::create([
            'name' => 'Hatha Yoga',
            'club_id' => 3,
        ]);
        Lesson::create([
            'name' => 'Vinyasa Yoga',
            'club_id' => 3,
        ]);
        Lesson::create([
            'name' => 'Power Yoga',
            'club_id' => 3,
        ]);
        Lesson::create([
            'name' => 'Restorative Yoga',
            'club_id' => 3,
        ]);
        Lesson::create([
            'name' => 'Ashtanga Yoga',
            'club_id' => 3,
        ]);
        Lesson::create([
            'name' => 'Karate',
            'club_id' => 4,
        ]);
        Lesson::create([
            'name' => 'Judo',
            'club_id' => 4,
        ]);
        Lesson::create([
            'name' => 'Taekwondo',
            'club_id' => 4,
        ]);
        Lesson::create([
            'name' => 'Boxing',
            'club_id' => 4,
        ]);
        Lesson::create([
            'name' => 'Brazilian Jiu-Jitsu',
            'club_id' => 4,
        ]);
        Lesson::create([
            'name' => 'Guitar Lessons',
            'club_id' => 5,
        ]);
        Lesson::create([
            'name' => 'Piano Lessons',
            'club_id' => 5,
        ]);
        Lesson::create([
            'name' => 'Drum Lessons',
            'club_id' => 5,
        ]);
        Lesson::create([
            'name' => 'Vocal Lessons',
            'club_id' => 5,
        ]);
        Lesson::create([
            'name' => 'Music Theory',
            'club_id' => 5,
        ]);
    }
}
