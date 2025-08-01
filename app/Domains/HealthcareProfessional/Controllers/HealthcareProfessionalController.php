<?php

namespace App\Domains\HealthcareProfessional\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\HealthcareProfessional\Services\HealthcareProfessionalService;
use App\Domains\HealthcareProfessional\Resources\HealthcareProfessionalResource;
use Illuminate\Http\JsonResponse;

/**
 * HealthcareProfessionalController
 *
 * Handles API requests related to healthcare professionals.
 *
 * @OA\Get(
 *     path="/api/professionals",
 *     summary="List all healthcare professionals",
 *     tags={"Healthcare Professionals"},
 *     @OA\Response(response=200, description="List retrieved successfully")
 * )
 */
class HealthcareProfessionalController extends Controller
{
    public function __construct(private HealthcareProfessionalService $service) {

    }

    /**
     * Get a list of all healthcare professionals.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $professionals = $this->service->getAll();
        return response()->json(HealthcareProfessionalResource::collection($professionals));
    }
}
