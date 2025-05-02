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
        Schema::create('program_enrollment', function(Blueprint $table){
            $table->id();
            $table->foreign('id_student')->references('id')->on('student')->onDelete('cascade')->nullable(false);

            $table->foreign('id_program')->references('id')->on('program')->onDelete('cascade')->nullable(false);

            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');

            $table->date('enrollment_date')->nullable(false);

            $table->date('graduation_date')->nullable();

        });



        Schema::create('term_enrollment', function(Blueprint $table){
            $table->id();

            $table->foreign('id_program_enrollment')->references('id')->on('program_enrollment')->onDelete('cascade')->nullable(false);
            $table->foreign('term_session_id')->references('id')->on('program_term_session')->onDelete('cascade')->nullable(false);

            $table->date('enrollment_date')->nullable(false);
  
            $table->enum('status', ['completed', 'incomplete', 'ongoing'])->default('ongoing');
        });

        // pivot table between term_enrollment and program_term_session_course

        Schema::create('term_enrollment_course', function(Blueprint $table){
            $table->id();
            $table->foreign('id_term_enrollment')->references('id')->on('term_enrollment')->onDelete('cascade')->nullable(false);
        
            $table->foreign('id_program_term_session_course')->references('id')->on('program_term_session_course')->onDelete('cascade')->nullable(false);
        
            $table->date('enrollment_date')->nullable(false);
         
            $table->enum('status', ['passed', 'ongoing', 'failed'])->default('ongoing');
        });


        // pivot table bw term_enrollment_course and program_term_course_class

        Schema::create('term_enrollment_course_class', function(Blueprint $table){
            $table->id();
       
            $table->foreign('id_term_enrollment_course')->references('id')->on('term_enrollment_course')->onDelete('cascade')->nullable(false);
            
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
          
        });
        



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('term_enrollment_course_class');
        Schema::dropIfExists('term_enrollment_course');
        Schema::dropIfExists('term_enrollment');
        Schema::dropIfExists('program_enrollment');
        
    }
};
