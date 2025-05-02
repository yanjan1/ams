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
        //
        Schema::create('program_term_course', function (Blueprint $table) {
            $table->id();
            $table->foreign('term_id')->references('id')->on('program_term')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('course')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
