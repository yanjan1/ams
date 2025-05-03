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
            $table->unsignedBigInteger('id_student')->nullable(false);
            $table->foreign('id_student')->references('id')->on('student')->onDelete('cascade')->nullable(false);

            $table->unsignedBigInteger('id_program')->nullable(false);
            $table->foreign('id_program')->references('id')->on('program')->onDelete('cascade')->nullable(false);

            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');

            $table->date('enrollment_date')->nullable(false);

            $table->date('graduation_date')->nullable();

        });



        Schema::create('term_enrollment', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('id_program_enrollment')->nullable(false);
            $table->foreign('id_program_enrollment')->references('id')->on('program_enrollment')->onDelete('cascade')->nullable(false);

            $table->unsignedBigInteger('term_session_id')->nullable(false);
            $table->foreign('term_session_id')->references('id')->on('program_term_session')->onDelete('cascade')->nullable(false);

            $table->date('enrollment_date')->nullable(false);
  
            $table->enum('status', ['completed', 'incomplete', 'ongoing'])->default('ongoing');
        });

        // pivot table between term_enrollment and program_term_session_course

        Schema::create('term_course_enrollment', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('id_term_enrollment')->nullable(false);
            $table->foreign('id_term_enrollment')->references('id')->on('term_enrollment')->onDelete('cascade')->nullable(false);
        
            $table->unsignedBigInteger('id_program_term_session_course')->nullable(false);
            $table->foreign('id_program_term_session_course')->references('id')->on('program_term_session_course')->onDelete('cascade')->nullable(false);
        
            $table->date('enrollment_date')->nullable(false);
         
            $table->enum('status', ['passed', 'ongoing', 'failed'])->default('ongoing');
        });


        // pivot table bw term_enrollment_course and program_term_course_class

        Schema::create('term_course_class_enrollment', function(Blueprint $table){
            $table->id();
       
            $table->unsignedBigInteger('id_term_enrollment_course')->nullable(false);
            $table->foreign('id_term_enrollment_course')->references('id')->on('term_course_enrollment')->onDelete('cascade')->nullable(false);
            
            $table->unsignedBigInteger('id_program_term_course_class')->nullable(false);
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
          
        });



        Schema::create('course_assignment_submission', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_course_assignment')->nullable(false);


            $table->foreign('id_course_assignment')->references('id')->on('course_assignment')->onDelete('cascade')->nullable(false);

            $table->unsignedInteger('id_student_course_enrollment')->nullable(false);
            $table->foreign('id_student_course_enrollment')->references('id')->on('term_course_class_enrollment')->onDelete('cascade')->nullable(false);
            $table->string('file_path')->nullable(false);
            $table->integer('marks_obtained')->nullable(false);
            $table->timestamps();
        }); 

        Schema::create('lecture_attendence', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_course_lecture')->nullable(false);
            $table->foreign('id_course_lecture')->references('id')->on('course_lecture')->onDelete('cascade')->nullable(false);
            $table->unsignedInteger('id_student_course_enrollment')->nullable(false);

            $table->foreign('id_student_course_enrollment')->references('id')->on('term_course_class_enrollment')->onDelete('cascade')->nullable(false);
            $table->enum('status', ['present', 'absent'])->nullable(false);
            $table->timestamps();
        });
        



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('lecture_attendence');
        Schema::dropIfExists('course_assignment_submission');
        Schema::dropIfExists('term_course_class_enrollment');
        Schema::dropIfExists('term_course_enrollment');
        Schema::dropIfExists('term_enrollment');
        Schema::dropIfExists('program_enrollment');
        
        
    }
};
