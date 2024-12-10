<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'first_name' => 'Super',
            'last_name' => 'admin',
            'phone_number' => '+123456789',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'alice_johnson',
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'phone_number' => '+1234567890',
            'email' => 'alice.johnson@gmail.com',
            'club_id' => 1,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');
        User::create([
            'name' => 'bob_smith',
            'first_name' => 'Bob',
            'last_name' => 'Smith',
            'phone_number' => '+1234567891',
            'email' => 'bob.smith@gmail.com',
            'club_id' => 1,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');
        User::create([
            'name' => 'carol_lee',
            'first_name' => 'Carol',
            'last_name' => 'Lee',
            'phone_number' => '+1234567892',
            'email' => 'carol.lee@gmail.com',
            'club_id' => 1,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');
        User::create([
            'name' => 'david_brown',
            'first_name' => 'David',
            'last_name' => 'Brown',
            'phone_number' => '+1234567893',
            'email' => 'david.brown@gmail.com',
            'club_id' => 2,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');
        User::create([
            'name' => 'evelyn_davis',
            'first_name' => 'Evelyn',
            'last_name' => 'Davis',
            'phone_number' => '+1234567894',
            'email' => 'evelyn.davis@gmail.com',
            'club_id' => 2,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');
        User::create([
            'name' => 'frank_wilson',
            'first_name' => 'Franklin',
            'last_name' => 'Wilson',
            'phone_number' => '+1234567895',
            'email' => 'franklin.wilson@gmail.com',
            'club_id' => 2,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');
        User::create([
            'name' => 'grace_thomas',
            'first_name' => 'Grace',
            'last_name' => 'Thomas',
            'phone_number' => '+1234567896',
            'email' => 'grace.thomas@gmail.com',
            'club_id' => 3,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');
        User::create([
            'name' => 'henry_martin',
            'first_name' => 'Henry',
            'last_name' => 'Martin',
            'phone_number' => '+1234567897',
            'email' => 'henry.martin@gmail.com',
            'club_id' => 3,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');

        User::create([
            'name' => 'isabel_clark',
            'first_name' => 'Isabel',
            'last_name' => 'Clark',
            'phone_number' => '+1234567898',
            'email' => 'isabel.clark@gmail.com',
            'club_id' => 4,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');

        User::create([
            'name' => 'james_davis',
            'first_name' => 'James',
            'last_name' => 'Davis',
            'phone_number' => '+12345678916',
            'email' => 'james.davis@gmail.com',
            'club_id' => 4,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');

        User::create([
            'name' => 'karen_wright',
            'first_name' => 'Karen',
            'last_name' => 'Wright',
            'phone_number' => '+12345678917',
            'email' => 'karen.wright@gmail.com',
            'club_id' => 4,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');

        User::create([
            'name' => 'lily_harris',
            'first_name' => 'Lily',
            'last_name' => 'Harris',
            'phone_number' => '+12345678918',
            'email' => 'lily.harris@gmail.com',
            'club_id' => 5,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');

        User::create([
            'name' => 'mark_lee',
            'first_name' => 'Mark',
            'last_name' => 'Lee',
            'phone_number' => '+12345678919',
            'email' => 'mark.lee@gmail.com',
            'club_id' => 5,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');

        User::create([
            'name' => 'nancy_king',
            'first_name' => 'Nancy',
            'last_name' => 'King',
            'phone_number' => '+12345678920',
            'email' => 'nancy.king@gmail.com',
            'club_id' => 5,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('coach');

    }
}
