<?php
namespace App\Domains\Auth\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * Create and persist a new user in the database.
     *
     * @param  array<string, mixed>  $data  The validated user data.
     * @return User  The newly created user instance.
     */
    public function createUser(array $data): User
    {
        return User::create($data);
    }
}