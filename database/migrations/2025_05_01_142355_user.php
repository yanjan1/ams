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
            $table->string('password');
            $table->boolean('active')->default(false);
            $table->timestamps();
        });

        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->id();

            // forign key refrence
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->nullable(false);

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
