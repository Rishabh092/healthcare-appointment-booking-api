<?php

namespace App\Domains\HealthcareProfessional\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreHealthcareProfessionalRequest
 *
 * Handles validation rules for storing a new healthcare professional.
 * Ensures required fields like name, email, specialization, and available days are provided and valid.
 */
class StoreHealthcareProfessionalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Modify this if you want to restrict access
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
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:healthcare_professionals,email',
            'specialization' => 'required|string|max:255',
            'available_days' => 'required|array',
        ];
    }
}