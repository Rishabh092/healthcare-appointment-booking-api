<?php
namespace App\Domains\User\Services;

use App\Domains\User\Models\User;

class UserService
{
    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  int  $id  The ID of the user to retrieve.
     * @return User|null  Returns the User model if found, or null if not found.
     */
    public function getById(int $id): ?User
    {
        return User::find($id);
    }
}