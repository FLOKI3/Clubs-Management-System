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
        Room::create([
            'name' => 'Room 1',
            'club_id' => 1,
        ]);
        Room::create([
            'name' => 'Room 2',
            'club_id' => 1,
        ]);
        Room::create([
            'name' => 'Room 3',
            'club_id' => 1,
        ]);
        Room::create([
            'name' => 'Room 4',
            'club_id' => 1,
        ]);
        Room::create([
            'name' => 'Room 5',
            'club_id' => 1,
        ]);
        Room::create([
            'name' => 'Room 1',
            'club_id' => 2,
        ]);
        Room::create([
            'name' => 'Room 2',
            'club_id' => 2,
        ]);
        Room::create([
            'name' => 'Room 3',
            'club_id' => 2,
        ]);
        Room::create([
            'name' => 'Room 4',
            'club_id' => 2,
        ]);
        Room::create([
            'name' => 'Room 5',
            'club_id' => 2,
        ]);
        Room::create([
            'name' => 'Room 1',
            'club_id' => 3,
        ]);
        Room::create([
            'name' => 'Room 2',
            'club_id' => 3,
        ]);
        Room::create([
            'name' => 'Room 3',
            'club_id' => 3,
        ]);
        Room::create([
            'name' => 'Room 4',
            'club_id' => 3,
        ]);
        Room::create([
            'name' => 'Room 5',
            'club_id' => 3,
        ]);
        Room::create([
            'name' => 'Room 1',
            'club_id' => 4,
        ]);
        Room::create([
            'name' => 'Room 2',
            'club_id' => 4,
        ]);
        Room::create([
            'name' => 'Room 3',
            'club_id' => 4,
        ]);
        Room::create([
            'name' => 'Room 4',
            'club_id' => 4,
        ]);
        Room::create([
            'name' => 'Room 5',
            'club_id' => 4,
        ]);
        Room::create([
            'name' => 'Room 1',
            'club_id' => 5,
        ]);
        Room::create([
            'name' => 'Room 2',
            'club_id' => 5,
        ]);
        Room::create([
            'name' => 'Room 3',
            'club_id' => 5,
        ]);
        Room::create([
            'name' => 'Room 4',
            'club_id' => 5,
        ]);
        Room::create([
            'name' => 'Room 5',
            'club_id' => 5,
        ]);
    }
}
