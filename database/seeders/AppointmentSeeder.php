<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Domains\Appointment\Models\Appointment;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $doctor = HealthcareProfessional::first();

        if (!$user || !$doctor) {
            $this->command->warn('No users or healthcare professionals found. Skipping AppointmentSeeder.');
            return;
        }

        Appointment::create([
            'user_id' => $user->id,
            'healthcare_professional_id' => $doctor->id,
            'appointment_time' => Carbon::now()->addDays(2),
            'status' => 'scheduled',
        ]);

        Appointment::create([
            'user_id' => $user->id,
            'healthcare_professional_id' => $doctor->id,
            'appointment_time' => Carbon::now()->addDays(3),
            'status' => 'scheduled',
        ]);
    }
}
