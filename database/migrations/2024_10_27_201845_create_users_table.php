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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // This is equivalent to auto_increment primary key
            $table->string('name');
            $table->string('title', 30)->nullable(); // For teacher
            $table->string('registration_number', 20)->nullable();
            $table->string('session', 10)->nullable();
            $table->string('email')->unique();
            $table->string('username', 100)->unique();
            $table->string('phone_number', 15)->nullable();
            $table->string('password');
            $table->string('image');
            $table->enum('user_type', ['Admin', 'Teacher', 'Student']);
            $table->enum('status', ['Pending', 'Approved'])->default('Pending');
            $table->timestamps(); // This will automatically add created_at and updated_at

            // Adding indexes for better performance
            $table->index('registration_number');
            $table->index('email');
            $table->index('user_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
