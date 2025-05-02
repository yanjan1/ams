<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // has building_id, and capacity, and type as enum of classroom, lab, auditorium
    public function up(): void
    {
        Schema::create('classroom', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade')->nullable(false);
            $table->integer('capacity')->nullable(false);
            $table->enum('type', ['classroom', 'lab', 'auditorium']);
            $table->unique(['number', 'building_id']);
            $table->timestamps();
            // foreign key to building
        });
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom');
    }
};
