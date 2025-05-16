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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            // activa indicated first time password set
            $table->boolean('active')->default(false)->nullable(false);
            // login_allow indicates if user is allowed to login
            $table->boolean('login_allow')->default(false)->nullable(false);
            $table->timestamps();
        });

        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->id();

            // forign key refrence
            $table->unsignedBigInteger('user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->nullable(false);

            $table->unsignedBigInteger('role_id');
            $table
                ->foreign('role_id')
                ->references('id')
                ->on('role')
                ->onDelete('cascade')
                ->nullable(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('role');
        Schema::dropIfExists('user_role');
    }
};
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
            $table->unsignedInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('Faculty', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('aadhar_number')->unique()->nullable(false);
            $table->string('faculty_address')->nullable(false);
            $table->string('faculty_phone_no')->nullable(false);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('DEO', function(Blueprint $table){
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('aadhar_number')->unique()->nullable(false);
            $table->string('deo_address')->nullable(false);
            $table->string('deo_phone_no')->nullable(false);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
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

        Schema::create('course', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable(false);
            $table->text('syllabus')->nullable(false);
            $table->unsignedBigInteger('department_id')->nullable(false);
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
            $table->unsignedBigInteger('building_id')->nullable(false);
            $table->foreign('building_id')->references('id')->on('building')->onDelete('cascade')->nullable(false);
            $table->integer('capacity')->nullable(false);
            $table->enum('type', ['classroom', 'lab', 'auditorium']);
            $table->unique(['number', 'building_id']);
            $table->timestamps();
            // foreign key to building
        });

        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->unsignedBigInteger('department_id')->nullable(false);
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
            $table->unsignedInteger('program_id')->unsigned()->nullable(false);
            $table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('program_term_session', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_program_term_id')->nullable(false);
            $table->foreign('id_program_term_id')->references('id')->on('program_term')->onDelete('cascade')->nullable(false);
            $table->unsignedInteger('id_academic_session_id')->nullable(false);
            $table->foreign('id_academic_session_id')->references('id')->on('acedemic_session')->onDelete('cascade');
            $table->timestamps();
        });

        

        Schema::create('program_term_session_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_program_term_session')->nullable(false);
            $table->foreign('id_program_term_session')->references('id')->on('program_term_session')->onDelete('cascade')->nullable(false);

            $table->unsignedInteger('id_course')->nullable(false);
            $table->foreign('id_course')->references('id')->on('course')->onDelete('cascade')->nullable(false);

            $table->enum('course_type', ['core_course', 'program_elective', 'term_elective'])->nullable(false);

            $table->text('syllabus')->nullable(false);

            $table->integer('credits')->nullable(false);

            $table->timestamps();
        });


        Schema::create('program_term_course_class', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedInteger('id_program_term_session_course')->nullable(false);

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
            $table->unsignedInteger('id_program_term_course_class')->nullable(false);
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
            $table->unsignedInteger('id_faculty')->nullable(false);
            $table->foreign('id_faculty')->references('id')->on('Faculty')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });

        // Schedule one to many between program_term_course_class
        // it will be stored in rRule manner
        Schema::create('course_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_program_term_course_class')->nullable(false);
            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->string('rrule')->nullable(false);
            $table->string('exdate')->nullable(false);
        });

        // lecture against schedule one to many

        Schema::create('course_lecture', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_course_schedule')->nullable(false);
            $table->foreign('id_course_schedule')->references('id')->on('course_schedule')->onDelete('cascade')->nullable(false);
            $table->date('date')->nullable(false);
            $table->time('start_time')->nullable(false);
            $table->time('end_time')->nullable(false);
            $table->unsignedInteger('id_classroom')->nullable(false);
            $table->foreign('id_classroom')->references('id')->on('classroom')->onDelete('cascade')->nullable(false);
            $table->timestamps();
        });

        // attendence between student_course_enrollment and course_lecture student_course_class_enrollment
       

        // assignment against the program_term_course_class
        Schema::create('course_assignment', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_program_term_course_class')->nullable(false);

            $table->foreign('id_program_term_course_class')->references('id')->on('program_term_course_class')->onDelete('cascade')->nullable(false);

            $table->string('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->date('due_date')->nullable(false);
            $table->integer('max_marks')->nullable(false);
            $table->integer('min_marks')->nullable(false);
            $table->timestamps();
        });

        // assignment submission against the course_assignment and student_course_class_enrollment
       


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('course_assignment');
   
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
        Schema::create('otp', function(Blueprint $table){
            $table->id();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('otp')->unique();
            $table->string('token')->unique();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expires_at');
            $table->unsignedTinyInteger('tries')->default(0);
            $table->enum('purpose', ['account_activation', 'reset_password']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp');
    }
};
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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
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
        Schema::create('email_ids', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('email')->unique()->nullable(false);
            $table->timestamps();
        });

        Schema::create('email', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sender_id')->nullable(false);
            $table->foreign('sender_id')->references('id')->on('email_ids')->onDelete('cascade');
            $table->string('subject');
            $table->text('body');
            $table->timestamps();
        });

        Schema::create('email_receivers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('email_id')->nullable(false);
            $table->foreign('email_id')->references('id')->on('email')->onDelete('cascade');

            $table->unsignedInteger('receiver_id')->nullable(false);
            $table->foreign('receiver_id')->references('id')->on('email_ids')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::dropIfExists('email_recievers');
        Schema::dropIfExists('email_receivers');
        Schema::dropIfExists('email');
        Schema::dropIfExists('email_ids');
    }
};
