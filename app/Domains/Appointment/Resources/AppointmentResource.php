<?php

namespace App\Domains\Appointment\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * AppointmentResource
 *
 * Transforms the Appointment model into a consistent JSON structure
 * for API responses.
 */
class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'                         => $this->id,
            'user_id'                    => $this->user_id,
            'healthcare_professional_id' => $this->healthcare_professional_id,
            'appointment_time'           => $this->appointment_time,
            'status'                     => $this->status,
        ];
    }
}
