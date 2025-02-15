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
        Schema::table('posts', function (Blueprint $table) {
            // Đổi tên cột city thành province
            $table->renameColumn('city', 'province');

            // Thêm các cột mới sau cột ward
            $table->string('street')->after('ward');
            $table->string('house_number')->after('street');
            $table->json('features')->nullable()->after('house_number'); 
            $table->string('name_poster')->after('features');
            $table->string('email_poster')->after('name_poster');
            $table->string('phone_poster')->after('email_poster');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Đổi lại province thành city
            $table->renameColumn('province', 'city');

            // Xóa các cột đã thêm
            $table->dropColumn(['street', 'house_number', 'features', 'name_poster', 'email_poster', 'phone_poster']);
        });
    }
};
