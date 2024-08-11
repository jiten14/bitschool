<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */

    public function viewAny(User $user): bool
    {

        return $user->hasAnyPermission(['Auth','Editauth']);
        
    }

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

        return $user->hasAnyPermission(['Auth','Editauth']);
        
    }

    public function delete(User $user)
    {

        return $user->hasPermissionTo('Auth');
        
    }
    
}
