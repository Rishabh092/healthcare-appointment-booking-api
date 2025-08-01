<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;

class HealthcareProfessionalSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'name'             => 'Dr. Aarti Sharma',
                'specialization'   => 'Cardiologist',
                'available_days'   => json_encode(['Monday', 'Wednesday', 'Friday']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Dr. Rajeev Kumar',
                'specialization'   => 'Neurologist',
                'available_days'   => json_encode(['Tuesday', 'Thursday']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Dr. Sneha Mehta',
                'specialization'   => 'Dermatologist',
                'available_days'   => json_encode(['Monday', 'Thursday', 'Saturday']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'name'             => 'Dr. Vinod Patel',
                'specialization'   => 'Orthopedic',
                'available_days'   => json_encode(['Wednesday', 'Friday']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        HealthcareProfessional::insert($data);

        $this->command->info('Healthcare professionals seeded successfully.');
    }
}
