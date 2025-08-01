<?php

namespace App\Domains\User\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Domains\Appointment\Models\Appointment;

/**
 * User Model
 *
 * Represents an authenticated user of the application.
 * Uses Laravel Passport for API authentication.
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the healthcare professional associated with the appointment.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
