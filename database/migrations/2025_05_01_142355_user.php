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
