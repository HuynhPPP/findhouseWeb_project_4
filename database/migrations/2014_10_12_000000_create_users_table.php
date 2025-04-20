<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->string('phone');
      $table->string('photo')->nullable();
      $table->string('password');
      $table->enum('role', ["user", "poster", "admin"])->default("user");
      $table->enum('status', ['0', '1'])
        ->default('1')
        ->comment('1: active, 0: unactive');
      $table->timestamp('email_verified_at')->nullable();
      $table->timestamp('email_verification_expires_at')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
