<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // these are static terms each program has
    // like 1st semester, or like 1 quarter, each will have its duration in month
    // forien key to program
    public function up(): void
    {
        Schema::create('program_term', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name')->nullable(false);
            $table->integer('duration_in_months')->nullable(false);
            $table->integer('program_id')->unsigned()->nullable(false);
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_term');
    }
};
