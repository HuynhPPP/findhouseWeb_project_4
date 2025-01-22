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
        'user_id' => $faker->numberBetween(1, 50), // Giả sử có 50 users
        'category_id' => $faker->numberBetween(1, 10), // Giả sử có 10 categories
        'title' => $faker->sentence,
        'post_slug' => $faker->slug,
        'description' => $faker->paragraph,
        'price' => $faker->randomNumber(6),
        'area' => $faker->randomNumber(2) . ' m²',
        'address' => $faker->address,
        'city' => $faker->city,
        'district' => $faker->citySuffix,
        'ward' => $faker->streetName,
        'is_favorite' => $faker->randomElement(['0', '1']),
        'is_featured' => $faker->boolean,
        'published_at' => now(),
        'status' => $faker->randomElement(['pending', 'approved', 'rejected', 'hidden']),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
