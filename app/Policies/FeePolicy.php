<?php

namespace App\Policies;

use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FeePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */

    public function viewAny(User $user): bool
    {
 
        return $user->hasAnyPermission(['Admission','Fees']);
         
    }

    public function view(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
    }

    public function create(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
    }

    public function update(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
    }

    public function delete(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
    }

}
