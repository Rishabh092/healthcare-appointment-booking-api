<?php
namespace App\Domains\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Register a new user and generate an access token.
     *
     * @param  array<string, mixed>  $data  The validated registration data.
     * @return array<string, mixed>  The created user and access token.
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('API Token')->accessToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    /**
     * Authenticate a user and generate an access token.
     *
     * @param  array<string, mixed>  $data  The validated login credentials.
     * @return array<string, mixed>  The authenticated user and access token.
     *
     * @throws ValidationException If authentication fails.
     */
    public function login(array $data): array
    {
        if (!Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('API Token')->accessToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
