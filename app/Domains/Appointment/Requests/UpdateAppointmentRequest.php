<?php

namespace App\Domains\Appointment\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateAppointmentRequest
 *
 * Handles the validation for updating an existing appointment.
 * Validates appointment ID, future date/time, and optional notes.
 */
class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // You can customize this based on your authorization logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'appointment_id' => 'required|exists:appointments,id',
            'scheduled_at'   => 'required|date|after:now',
            'notes'          => 'nullable|string|max:500',
        ];
    }

    /**
     * Get the custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'appointment_id.required' => 'Appointment ID is required.',
            'appointment_id.exists'   => 'The specified appointment does not exist.',
            'scheduled_at.required'   => 'Scheduled time is required.',
            'scheduled_at.after'      => 'The new appointment time must be in the future.',
        ];
    }
}