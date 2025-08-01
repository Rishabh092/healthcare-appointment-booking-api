<?php

namespace App\Domains\HealthcareProfessional\Services;

use App\Domains\HealthcareProfessional\Repositories\HealthcareProfessionalRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * HealthcareProfessionalService
 *
 * Handles business logic related to healthcare professionals.
 * Acts as an intermediary between controllers and the repository layer.
 */
class HealthcareProfessionalService
{
    public function __construct(private HealthcareProfessionalRepository $repo) {}

    /**
     * Retrieve all healthcare professionals.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->repo->getAll();
    }
}
