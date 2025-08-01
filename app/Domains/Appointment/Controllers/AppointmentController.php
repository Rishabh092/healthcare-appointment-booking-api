<?php
namespace App\Domains\Appointment\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Appointment\Requests\BookAppointmentRequest;
use App\Domains\Appointment\Services\AppointmentService;
use App\Domains\Appointment\Resources\AppointmentResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Post(
 *     path="/api/appointments",
 *     summary="Book an appointment",
 *     tags={"Appointments"},
 *     security={{"passport":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"healthcare_professional_id", "appointment_date"},
 *             @OA\Property(property="healthcare_professional_id", type="integer", example=1),
 *             @OA\Property(property="appointment_date", type="string", format="date-time", example="2025-08-01T14:30:00Z")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Appointment booked successfully"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 */
class AppointmentController extends Controller
{
    /**
     * Inject the AppointmentService to delegate business logic.
     */
    public function __construct(private AppointmentService $service) {}


    /**
     * Book a new appointment.
     *
     * @param  BookAppointmentRequest  $request
     * @return JsonResponse
     */
    public function book(BookAppointmentRequest $request): JsonResponse
    {
        $appointment = $this->service->book($request->validated(), $request->user());
        return response()->json(new AppointmentResource($appointment), 201);
    }

     /**
     * Get a list of appointments for the authenticated user.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $appointments = $this->service->getUserAppointments($request->user());
        return response()->json(AppointmentResource::collection($appointments));
    }

    /**
     * Cancel an appointment by ID for the authenticated user.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return JsonResponse
     */
    public function cancel($id, Request $request): JsonResponse
    {
        $this->service->cancel($id, $request->user());
        return response()->json(['message' => 'Appointment canceled']);
    }
}
