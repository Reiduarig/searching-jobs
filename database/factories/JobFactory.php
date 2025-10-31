<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salaryMin = fake()->numberBetween(30000, 80000);
        $salaryMax = fake()->numberBetween($salaryMin, $salaryMin + 50000);
        
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'salary_min' => $salaryMin,
            'salary_max' => $salaryMax,
            'salary_period' => fake()->randomElement(['month', 'year']),
            'location' => fake()->randomElement(['Remoto', 'Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Bilbao']),
            'schedule' => fake()->randomElement(['full-time', 'part-time', 'contract', 'internship']),
            'experience_level' => fake()->randomElement(['entry', 'mid', 'senior', 'lead']),
            'education' => fake()->randomElement(['none', 'high_school', 'bachelor', 'master', 'phd']),
            'benefits' => fake()->randomElements([
                'Seguro médico', 
                'Trabajo remoto', 
                'Vacaciones flexibles', 
                'Formación continua',
                'Gimnasio', 
                'Comida gratis',
                'Stock options',
                'Horario flexible'
            ], fake()->numberBetween(2, 5)),
            'url' => fake()->url(),
            'featured' => fake()->boolean(10), // 10% featured
            'urgent' => fake()->boolean(5), // 5% urgent
            'duration' => fake()->randomElement([null, 3, 6, 12, 24]), // null for permanent
        ];
    }
}
