<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('site_settings', function (Blueprint $table) {
      $table->id();
      $table->string('logo')->nullable();
      $table->string('phone')->nullable();
      $table->string('email')->nullable();
      $table->string('address')->nullable();
      $table->string('facebook')->nullable();
      $table->string('youtube')->nullable();
      $table->string('copyright')->nullable();
    });
    DB::table('site_settings')->insert([
      'logo' => 'logo.png',
      'phone' => '0369455664',
      'email' => 'hotro@gmail.com',
      'address' => '256 Nguyễn Văn Cừ, Quận Ninh Kiều, Thành phố Cần Thơ',
      'facebook' => 'https://www.facebook.com/dvk0322',
      'youtube' => 'https://www.youtube.com/channel/UCE8VN4o0s6lBHN3QGMAVgXQ',
      'copyright' => 'Copyright © 2007 - 2025 FindHouse',
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('site_settings');
  }
};
