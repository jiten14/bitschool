<?php

namespace App\Policies;

use App\Models\ReferalAgent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReferalAgentPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {

        return $user->hasPermissionTo('Admission');
        
    }

}
