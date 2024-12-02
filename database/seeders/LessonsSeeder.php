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
        $clubs = Club::all();

        foreach ($clubs as $club) {
            for ($i = 1; $i <= 5; $i++) {
                Lesson::create([
                    'name' => "Lesson {$i} for {$club->name}",
                    'club_id' => $club->id,
                ]);
            }
        }
    }
}
