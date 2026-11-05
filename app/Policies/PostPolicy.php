<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Returning null lets Laravel check the specific method below.
        return null;
    }

    // Normal users can edit only their own posts.
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    // Normal users can delete only their own posts.
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
