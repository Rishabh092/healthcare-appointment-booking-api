<?php
namespace Database\Factories;

use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use Illuminate\Database\Eloquent\Factories\Factory;

class HealthcareProfessionalFactory extends Factory
{
    protected $model = HealthcareProfessional::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'specialization' => $this->faker->randomElement(['Cardiology', 'Dermatology', 'Orthopedics']),
            'available_days' => ['Monday', 'Wednesday', 'Friday'],
        ];
    }
}