<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermissionPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }

}
