<?php
namespace App\Domains\Appointment\Models;

use Illuminate\Database\Eloquent\Model;
use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use App\Domains\User\Models\User;


/**
 * Appointment Model
 *
 * Represents a healthcare appointment booked by a user with a healthcare professional.
 * Contains relationships to both the User and HealthcareProfessional models.
 */
class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'healthcare_professional_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    /**
     * Get the user who booked the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the healthcare professional associated with the appointment.
     */
    public function healthcareProfessional()
    {
        return $this->belongsTo(HealthcareProfessional::class);
    }
}
