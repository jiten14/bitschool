<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */

    public function view(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }

    public function create(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }

    public function update(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }

    public function delete(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }
    
}
