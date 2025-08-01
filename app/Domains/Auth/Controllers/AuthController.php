<?php
namespace App\Domains\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Domains\Auth\Requests\LoginRequest;
use App\Domains\Auth\Requests\RegisterRequest;
use App\Domains\Auth\Services\AuthService;
use App\Domains\Auth\Resources\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Healthcare Appointment Booking API",
 *     description="API documentation for the Healthcare Appointment Booking system"
 * )
 *
 * @OA\Post(
 *     path="/api/auth/register",
 *     summary="Register a new user",
 *     @OA\RequestBody,
 *     @OA\Response(response=201, description="Created")
 * )
 *
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="User login",
 *     @OA\RequestBody,
 *     @OA\Response(response=200, description="Success")
 * )
 */
class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {

    }

    /**
     * Handle the registration of a new user.
     *
     * @param  RegisterRequest  $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $this->authService->register($request->validated());

        return response()->json(new AuthResource($data), 201);
    }

    /**
     * Handle user login and return access token.
     *
     * @param  LoginRequest  $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());
        return response()->json(new AuthResource($data), 200);
    }

    /**
     * Revoke the current user's access token (logout).
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
