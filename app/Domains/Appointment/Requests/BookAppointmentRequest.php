<?php

namespace App\Domains\Appointment\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * BookAppointmentRequest
 *
 * Handles validation rules for booking an appointment.
 * Ensures that the selected healthcare professional exists and that
 * the appointment date and time are valid and correctly formatted.
 */
class BookAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Only authenticated users are allowed to book appointments
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'healthcare_professional_id' => 'required|exists:healthcare_professionals,id',
            'appointment_date'           => 'required|date|after_or_equal:today',
            'appointment_time'           => 'required|date_format:H:i',
        ];
    }
}
