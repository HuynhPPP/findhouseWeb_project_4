<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 200) as $index) {
      DB::table('images')->insert([
        'post_id' => $faker->numberBetween(1, 100), // Giả sử bảng posts có 100 bản ghi
        'image_url' => $faker->imageUrl(800, 600, 'room', true, 'Phong Tro'),
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
  }
}
