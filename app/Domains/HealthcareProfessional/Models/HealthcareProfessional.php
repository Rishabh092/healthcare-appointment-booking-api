<?php

namespace App\Domains\HealthcareProfessional\Models;
use App\Domains\Appointment\Models\Appointment;
use Illuminate\Database\Eloquent\Model;

/**
 * HealthcareProfessional Model
 *
 * Represents a healthcare professional in the system.
 * Stores information like name, email, specialization,
 * and available working days (as an array).
 */
class HealthcareProfessional extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'specialization',
        'available_days',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'available_days' => 'array',
    ];

    public function appointment()
    {

        
    }
}
