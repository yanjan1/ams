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
            $table->string('email');
            $table->string('otp');
            $table->boolean('is_verified')->default(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expires_at');
            $table->enum('purpose', ['activate_account', 'reset_password']); 
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
