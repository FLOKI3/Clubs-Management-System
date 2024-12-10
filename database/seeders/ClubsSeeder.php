<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Club::create([
            'name' => 'Fitness Club',
        ]);

        Club::create([
            'name' => 'Sports Club',
        ]);

        Club::create([
            'name' => 'Yoga Club',
        ]);

        Club::create([
            'name' => 'Martial Arts Club',
        ]);

        Club::create([
            'name' => 'Music Club',
        ]);
    }
}
