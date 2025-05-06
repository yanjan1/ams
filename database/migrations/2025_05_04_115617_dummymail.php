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
