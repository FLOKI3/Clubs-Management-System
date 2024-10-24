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
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');

        User::create([
            'name' => 'developer',
            'email' => 'developer@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('developer');
        
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('user');
    }
}
