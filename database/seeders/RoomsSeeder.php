<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $clubs = Club::all();

        foreach ($clubs as $club) {
            for ($i = 1; $i <= 5; $i++) {
                Room::create([
                    'name' => "Room {$i} for {$club->name}",
                    'club_id' => $club->id,
                ]);
            }
        }
    }
}
