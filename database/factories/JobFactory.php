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
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle,
            'salary' => fake()->numberBetween(30000, 120000),
            'location' => 'Remoto',
            'schedule' => fake()->randomElement(['full-time', 'part-time', 'contract']),
            'url' => fake()->url,
            'featured' => false
        ];
    }
}
