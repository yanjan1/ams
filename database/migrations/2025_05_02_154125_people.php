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
        Schema::create('student', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('aadhar_number')->unique()->nullable(false);
            $table->string('parent_name')->unique()->nullable(false);
            $table->string('stundent_address')->nullable(false);
            $table->string('student_phone_no')->nullable(false);
            $table->timestamps();
        });

        Schema::create('Faculty', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('aadhar_number')->unique()->nullable(false);
            $table->string('faculty_address')->nullable(false);
            $table->string('faculty_phone_no')->nullable(false);
            $table->timestamps();
        });

        Schema::create('DEO', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('aadhar_number')->unique()->nullable(false);
            $table->string('deo_address')->nullable(false);
            $table->string('deo_phone_no')->nullable(false);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Student');
        Schema::dropIfExists('Employee');
        Schema::dropIfExists('DEO');
        Schema::dropIfExists('Faculty');
    }
};
