<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 20) as $index) {
      DB::table('categories')->insert([
        'category_name' => $faker->word,
        'category_slug' => $faker->slug,
        'status' => $faker->randomElement(['hidden', 'show']),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
