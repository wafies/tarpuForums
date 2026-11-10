<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        // Returning null lets Laravel check the specific method below.
        return null;
    }

    // Normal users can only delete their own profile
    // user is the authenticated user who is trying to delete,
    // delete is the user whos profile is being deleted
    public function delete(User $user, User $delete): bool
    {
        return $user->id === $delete->id;
    }
}
