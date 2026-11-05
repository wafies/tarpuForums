<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    public function delete(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }
}
