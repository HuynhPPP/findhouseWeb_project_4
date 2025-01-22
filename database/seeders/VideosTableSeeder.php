<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class VideosTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 100) as $index) {
      DB::table('videos')->insert([
        'post_id' => $faker->numberBetween(1, 100), // Giả sử bảng posts có 100 bản ghi
        'video_url' => $faker->url,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
