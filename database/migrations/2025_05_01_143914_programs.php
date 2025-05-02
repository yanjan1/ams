<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * program, program_duration in months , name, offerend under department
     */
    public function up(): void
    {
       Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade')->nullable(false);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('programs');
    }
};
