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
            'phone_number' => '123456789',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('admin');
        
        User::create([
            'name' => 'manager',
            'first_name' => 'Val',
            'last_name' => 'halla',
            'phone_number' => '123456789',
            'email' => 'manager@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('manager');

        User::create([
            'name' => 'developer',
            'first_name' => 'Val',
            'last_name' => 'halla',
            'phone_number' => '123456789',
            'email' => 'developer@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('developer');
        
        User::create([
            'name' => 'user',
            'first_name' => 'Val',
            'last_name' => 'halla',
            'phone_number' => '123456789',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
        ])->assignRole('user');
    }
}
