<?php

namespace App\Policies;

use App\Models\FeeType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeeTypePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
    }

}
