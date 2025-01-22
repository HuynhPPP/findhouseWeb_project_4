<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    $this->call([
      UsersTableSeeder::class,
      CategoriesTableSeeder::class,
      PostsTableSeeder::class,
      ImagesTableSeeder::class,
      VideosTableSeeder::class,
    ]);
  }
}
