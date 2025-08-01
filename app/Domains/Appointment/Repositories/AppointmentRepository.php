<?php
namespace App\Domains\Appointment\Repositories;

use App\Domains\Appointment\Models\Appointment;


/**
 * AppointmentRepository
 *
 * Handles all data access logic related to Appointment model,
 * providing abstraction over Eloquent operations for appointments.
 */
class AppointmentRepository
{
    /**
     * Create a new appointment record.
     *
     * @param array $data
     * @return Appointment
     */
    public function create(array $data): Appointment
    {
        return Appointment::create($data);
    }

    /**
     * Get all appointments for a specific user, ordered by latest.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByUser(int $userId)
    {
        return Appointment::where('user_id', $userId)->latest()->get();
    }

    /**
     * Find a specific appointment by its ID and user ID.
     *
     * @param int $id
     * @param int $userId
     * @return Appointment|null
     */
    public function findByUser(int $id, int $userId): ?Appointment
    {
        return Appointment::where('id', $id)->where('user_id', $userId)->first();
    }

    /**
     * Check for appointment conflict for a healthcare professional
     * at a specific date and time with 'booked' status.
     *
     * @param int $professionalId
     * @param string $date
     * @param string $time
     * @return bool
     */
    public function checkConflict($professionalId, $date, $time): bool
    {
        return Appointment::where('healthcare_professional_id', $professionalId)
            ->where('appointment_date', $date)
            ->where('appointment_time', $time)
            ->where('status', 'booked')
            ->exists();
    }
}
