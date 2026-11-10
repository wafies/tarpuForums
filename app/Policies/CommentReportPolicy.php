<?php

namespace App\Policies;

use App\Models\CommentReport;
use App\Models\User;

class CommentReportPolicy
{
    public function delete(User $user, CommentReport $report): bool
    {
        return $user->isAdmin(); //just admins
    }
}
