<?php

namespace App\Policies;

use App\Models\Prediction;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PredictionPolicy
{
    public function view(User $user, Prediction $prediction): bool
    {
        $groups = $user->groups()->pluck('id')->toArray() ?? null;
        $groupId = $prediction->group->id;
        return $prediction->group->name == 'Personal' || in_array($groupId, $groups);
    }
}
