<?php

namespace App\Domains\Appointment\Services;

use App\Domains\Appointment\Repositories\AppointmentRepository;
use App\Domains\Appointment\Models\Appointment;
use App\Domains\User\Models\User;
use Illuminate\Support\Carbon;

/**
 * AppointmentService
 *
 * Contains business logic related to appointment booking, cancellation,
 * and retrieval. It acts as a middle layer between controllers and repositories.
 */
class AppointmentService
{
    public function __construct(private AppointmentRepository $repo) {}

    /**
     * Book a new appointment if no conflict exists.
     *
     * @param array $data
     * @param User $user
     * @return Appointment
     * @throws \Exception If the time slot is already booked.
     */
    public function book(array $data, User $user): Appointment
    {
        $exists = $this->repo->checkConflict(
            $data['healthcare_professional_id'],
            $data['appointment_date'],
            $data['appointment_time']
        );

        if ($exists) {
            throw new \Exception("Time slot is already booked.");
        }

        return $this->repo->create(array_merge($data, [
            'user_id' => $user->id,
            'status' => 'booked',
        ]));
    }

    /**
     * Retrieve all appointments for a given user.
     *
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUserAppointments(User $user)
    {
        return $this->repo->getByUser($user->id);
    }

    /**
     * Cancel an appointment by its ID, ensuring it belongs to the user.
     *
     * @param int $id
     * @param User $user
     * @throws \Exception If the appointment is not found or user is unauthorized.
     */
    public function cancel(int $id, User $user): void
    {
        $appointment = $this->repo->findByUser($id, $user->id);
        if (!$appointment) {
            throw new \Exception("Appointment not found or unauthorized.");
        }

        $appointment->update(['status' => 'cancelled']);
    }
}
