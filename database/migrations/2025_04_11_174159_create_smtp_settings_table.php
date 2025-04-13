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
    Schema::create('smtp_settings', function (Blueprint $table) {
      $table->id();
      $table->string('mailer')->nullable();
      $table->string('host')->nullable();
      $table->string('port')->nullable();
      $table->string('username')->nullable();
      $table->string('password')->nullable();
      $table->string('encryption')->nullable();
      $table->string('from_address')->nullable();
      $table->timestamps();
    });
    DB::table('smtp_settings')->insert([
      'mailer' => 'smtp',
      'host' => 'sandbox.smtp.mailtrap.io',
      'port' => '2525',
      'username' => '2f8ca72232a654',
      'password' => '4ea232aa95dfd7',
      'encryption' => 'tls',
      'from_address' => 'hotro.findhouse@gmail.com',
      'created_at' => now(),
      'updated_at' => now(),
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('smtp_settings');
  }
};
