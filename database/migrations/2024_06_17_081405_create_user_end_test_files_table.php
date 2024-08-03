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
        Schema::create('user_end_test_files', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longtext('file_1')->nullable();
            $table->longtext('file_2')->nullable();
            $table->integer('result')->nullable()->default(0);
            $table->integer('course_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_end_test_files');
    }
};
