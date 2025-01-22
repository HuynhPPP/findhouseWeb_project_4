<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 50) as $index) {
      DB::table('users')->insert([
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'password' => Hash::make('12345'),
        'role' => $faker->randomElement(['user', 'poster', 'admin']),
        'status' => $faker->randomElement(['0', '1']),
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
