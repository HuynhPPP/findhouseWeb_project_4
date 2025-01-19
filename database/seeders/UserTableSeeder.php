<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            // User
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'phone' => '0900456789',
                'password' => Hash::make('12345'),
                'role' => 'user',
                'status' => '1',
            ],
            // Poster
            [
                'name' => 'Poster',
                'email' => 'poster@gmail.com',
                'phone' => '0900987654',
                'password' => Hash::make('12345'),
                'role' => 'poster',
                'status' => '1',
            ],
        ]);
    }
}
