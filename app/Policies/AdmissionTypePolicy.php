<?php

namespace App\Policies;

use App\Models\AdmissionType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdmissionTypePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {

        return $user->hasPermissionTo('Setup');
        
    }

}
