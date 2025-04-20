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
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
      $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
      $table->string('title');
      $table->string('post_slug');
      $table->text('description');
      $table->bigInteger('price');
      $table->string('area');
      $table->string('province');
      $table->string('district');
      $table->string('ward');
      $table->string('street');
      $table->string('house_number');
      $table->string('video_url')->nullable();
      $table->tinyInteger('is_favorite')->default(0);
      $table->tinyInteger('is_featured')->default(0);
      $table->enum('status', ["pending", "approved", "hidden"])->default("pending");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('posts');
  }
};
