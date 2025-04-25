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
      $table->string('mailer');
      $table->string('host');
      $table->string('port');
      $table->string('username');
      $table->string('password');
      $table->string('encryption');
      $table->string('from_address');
    });
    DB::table('smtp_settings')->insert([
      'mailer' => 'smtp',
      'host' => 'sandbox.smtp.mailtrap.io',
      'port' => '2525',
      'username' => '2f8ca72232a654',
      'password' => '4ea232aa95dfd7',
      'encryption' => 'tls',
      'from_address' => 'hotro.findhouse@gmail.com',
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
