<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 100) as $index) {
      DB::table('posts')->insert([
        'user_id' => $faker->numberBetween(1, 50),
        'category_id' => $faker->numberBetween(1, 20),
        'title' => $faker->sentence,
        'post_slug' => $faker->slug,
        'description' => $faker->paragraph,
        'price' => $faker->randomNumber(6),
        'area' => $faker->randomNumber(2),
        'province' => $faker->city,
        'district' => $faker->citySuffix,
        'ward' => $faker->streetName,
        'street' => $faker->streetName,
        'house_number' => $faker->randomNumber(3) . '/' . $faker->randomNumber(2) . '/' . $faker->randomNumber(2),
        'is_favorite' => $faker->boolean,
        'is_featured' => $faker->boolean,
        'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
