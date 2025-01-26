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
      $table->string('price');
      $table->string('area');
      $table->string('address');
      $table->string('city');
      $table->string('district');
      $table->string('ward');
      $table->enum('is_favorite', ["0", "1"]);
      $table->tinyInteger('is_featured');
      $table->timestamp('published_at');
      $table->enum('status', ["pending", "approved", "rejected", "hidden"]);
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
