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
        // Get 10 random users to act as managers 2 3 4
        $managers = User::whereIn('id', [2, 3, 4])->inRandomOrder()->take(3)->get();

        foreach ($managers as $index => $manager) {
            // Define a unique role name for the club
            $roleName = "Club " . ($index + 1);

            // Create the club
            $club = Club::create([
                'name' => "Club " . ($index + 1),
                'manager_id' => $manager->id,
                'guard_name' => $roleName,
            ]);

            // Create the role if it doesn't already exist
            Role::findOrCreate($roleName);

            // Assign the role to the manager
            $manager->assignRole($roleName, 'manager');
        }
    }
}
