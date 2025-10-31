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
        Schema::table('jobs', function (Blueprint $table) {
            // Campos de descripción y detalles
            $table->text('description')->nullable()->after('title');
            
            // Campos de salario (reemplazar el campo actual)
            $table->dropColumn('salary');
        });
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->decimal('salary_min', 10, 2)->nullable()->after('description');
            $table->decimal('salary_max', 10, 2)->nullable()->after('salary_min');
            $table->enum('salary_period', ['hour', 'day', 'week', 'month', 'year'])->default('month')->after('salary_max');
            
            // Campos de experiencia y educación
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'lead'])->nullable()->after('schedule');
            $table->enum('education', ['none', 'high_school', 'bachelor', 'master', 'phd'])->nullable()->after('experience_level');
            
            // Campos de beneficios (JSON para múltiples valores)
            $table->json('benefits')->nullable()->after('education');
            
            // Campos adicionales
            $table->boolean('urgent')->default(false)->after('featured');
            $table->integer('duration')->nullable()->comment('Duration in months')->after('urgent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'description', 
                'salary_min', 
                'salary_max', 
                'salary_period',
                'experience_level',
                'education',
                'benefits',
                'urgent',
                'duration'
            ]);
        });
        
        Schema::table('jobs', function (Blueprint $table) {
            $table->float('salary')->after('title');
        });
    }
};
