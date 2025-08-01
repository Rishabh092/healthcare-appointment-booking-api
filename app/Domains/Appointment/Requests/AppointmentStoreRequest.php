<?php

namespace App\Domains\Appointment\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * AppointmentStoreRequest
 *
 * Handles validation logic for booking a new appointment.
 * Ensures the user is authenticated and inputs are valid.
 */
class AppointmentStoreRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Only authenticated users can book an appointment
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
            'appointment_time' => 'required|date|after:now',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'healthcare_professional_id.required' => 'Healthcare professional is required.',
            'healthcare_professional_id.exists'   => 'Selected healthcare professional does not exist.',
            'appointment_time.required'           => 'Appointment time is required.',
            'appointment_time.date'               => 'Appointment time must be a valid datetime.',
            'appointment_time.after'              => 'Appointment time must be in the future.',
        ];
    }
}
