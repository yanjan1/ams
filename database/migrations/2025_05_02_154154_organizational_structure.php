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
        Schema::create('department', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable(false);
            $table->timestamps();
        });

        Schema::craete('course', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable(false);
            $table->text('syllabus')->nullable(false);
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('building', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

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

        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade')->nullable(false);
            $table->timestamps();
            
        });

        Schema::create('acedemic_session', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->timestamps();
        });

        Schema::create('program_term', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name')->nullable(false);
            $table->integer('duration_in_months')->nullable(false);
            $table->integer('program_id')->unsigned()->nullable(false);
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });

        Schema::create('program_term_session', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_program_term_id')->references('id')->on('program_term')->onDelete('cascade')->nullable(false);
            $table->foreign('id_session_id')->references('id')->on('session')->onDelete('cascade');
            $table->timestamps();
        });
        

        Schema::create('program_term_session_course', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_program_term_session')->references('id')->on('program_term_session')->onDelete('cascade')->nullable(false);

            $table->foreign('id_course')->references('id')->on('course')->onDelete('cascade')->nullable(false);

            $table->enum('course_type', ['core_course', 'program_elective', 'term_elective'])->nullable(false);

            $table->text('syllabus')->nullable(false);

            $table->integer('credits')->nullable(false);

            $table->timestamps();
        });


        Schema::create('program_term_course_class', function (Blueprint $table) {
            $table->id();
            
            $table
                ->foreign('id_program_term_session_course')->references('id')
                ->on('program_term_session_course')
                ->onDelete('cascade')
                ->nullable(false);


            $table->string('class_name')->nullable(false);
            $table->timestamps();
        });

        // pivot table between program_term_course_class and faculty
        // many to many relationship

        Schema::create('program_term_course_class_faculty', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
            $table->foreign('id_faculty')->references('id')->on('faculty')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });

        // Schedule one to many between program_term_course_class
        // it will be stored in rRule manner
        Schema::create('course_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->string('rrule')->nullable(false);
            $table->string('exdate')->nullable(false);
        });

        // lecture against schedule one to many

        Schema::create('course_lecture', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_course_schedule')->references('id')->on('course_schedule')->onDelete('cascade')->nullable(false);
            $table->date('date')->nullable(false);
            $table->time('start_time')->nullable(false);
            $table->time('end_time')->nullable(false);
            $table->foreign('id_classroom')->references('id')->on('classroom')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });

        // attendence between student_course_enrollment and course_lecture student_course_class_enrollment
        Schema::create('course_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_course_lecture')->references('id')->on('course_lecture')->onDelete('cascade')->nullable(false);
            $table->foreign('id_student_course_enrollment')->references('id')->on('student_course_class_enrollment')->onDelete('cascade')->nullable(false);
            $table->enum('status', ['present', 'absent'])->nullable(false);
            $table->timestamps();
        });

        // assignment against the program_term_course_class
        Schema::create('course_assignment', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->date('due_date')->nullable(false);
            $table->integer('max_marks')->nullable(false);
            $table->integer('min_marks')->nullable(false);
            $table->timestamps();
        });

        // assignment submission against the course_assignment and student_course_class_enrollment
        Schema::create('course_assignment_submission', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_course_assignment')->references('id')->on('course_assignment')->onDelete('cascade')->nullable(false);
            $table->foreign('id_student_course_enrollment')->references('id')->on('student_course_class_enrollment')->onDelete('cascade')->nullable(false);
            $table->string('file_path')->nullable(false);
            $table->integer('marks_obtained')->nullable(false);
            $table->timestamps();
        }); 


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_assignment_submission');
        Schema::dropIfExists('course_assignment');
        Schema::dropIfExists('course_attendance');
        Schema::dropIfExists('course_lecture');
        Schema::dropIfExists('course_schedule');
        Schema::dropIfExists('program_term_course_class_faculty');
        Schema::dropIfExists('program_term_course_class');
        Schema::dropIfExists('program_term_session_course');
        Schema::dropIfExists('program_term_session');
        Schema::dropIfExists('program_term');
        Schema::dropIfExists('acedemic_session');
        Schema::dropIfExists('program');
        Schema::dropIfExists('classroom');
        Schema::dropIfExists('building');
        Schema::dropIfExists('course');
        Schema::dropIfExists('department');
    }
};
