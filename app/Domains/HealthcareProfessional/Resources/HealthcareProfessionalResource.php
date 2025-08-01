<?php

namespace App\Domains\HealthcareProfessional\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * HealthcareProfessionalResource
 *
 * Transforms a HealthcareProfessional model into a standardized JSON structure
 * for API responses.
 */
class HealthcareProfessionalResource extends JsonResource
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
            'id'             => $this->id,
            'name'           => $this->name,
            'email'          => $this->email,
            'specialization' => $this->specialization,
            'available_days' => $this->available_days,
        ];
    }
}