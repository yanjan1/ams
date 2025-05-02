<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** 
     * pivot table for many-to-many relationship between users and roles
     */
    public function up(): void
    {
        Schema::create('use_role', function (Blueprint $table) {
            $table->id();
           
            // forign key refrence
            $table->foreign('user_id')
                ->references('id')
                ->on('user')
                ->onDelete('cascade')
                ->nullable(false);

            $table->foreign('role_id')
                    ->references('id')
                    ->on('role')
                    ->onDelete('cascade')
                    ->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
