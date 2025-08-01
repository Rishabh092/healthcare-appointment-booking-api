<?php
namespace Database\Factories;

use App\Domains\Appointment\Models\Appointment;
use App\Domains\User\Models\User;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'healthcare_professional_id' => HealthcareProfessional::factory(),
            'appointment_date' => now()->addDay()->toDateString(),
            'appointment_time' => '10:00',
            'status' => 'booked',
        ];
    }
}