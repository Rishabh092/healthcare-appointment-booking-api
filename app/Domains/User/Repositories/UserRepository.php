<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Models\User;

/**
 * UserRepository
 *
 * Provides data access methods related to the User model.
 * Acts as an abstraction layer between the database and business logic.
 */
class UserRepository
{
    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        return User::find($id);
    }
}