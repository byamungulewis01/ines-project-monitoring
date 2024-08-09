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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('reg_number')->unique();
            $table->string('phone')->unique();
            $table->foreignId('department_id')->constrained()->restrictOnDelete();
            $table->string('option');
            $table->string('password')->nullable();
            $table->enum('status', ['active', 'block'])->default('active');
            $table->string('academic_year');
            $table->enum('student_status', ['student', 'alumni'])->default('student');
            $table->date('completion_date')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
