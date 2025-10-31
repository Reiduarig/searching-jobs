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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'reviewed', 'interviewed', 'accepted', 'rejected'])->default('pending');
            $table->text('cover_letter')->nullable();
            $table->string('cv_path')->nullable();
            $table->json('questions_answers')->nullable(); // Para respuestas a preguntas específicas del empleador
            $table->timestamp('applied_at');
            $table->timestamps();
            
            // Evitar aplicaciones duplicadas
            $table->unique(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
