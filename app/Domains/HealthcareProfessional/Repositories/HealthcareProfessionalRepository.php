<?php

namespace App\Domains\HealthcareProfessional\Repositories;

use App\Domains\HealthcareProfessional\Models\HealthcareProfessional;
use Illuminate\Database\Eloquent\Collection;

/**
 * HealthcareProfessionalRepository
 *
 * Provides data access methods for healthcare professionals.
 * Acts as an abstraction layer between the model and service layers.
 */
class HealthcareProfessionalRepository
{
    private HealthcareProfessional $model;

    public function __construct()
    {

    }

    /**
     * Retrieve all healthcare professionals using static model access.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll(): Collection
    {
        return HealthcareProfessional::all();
    }
}
