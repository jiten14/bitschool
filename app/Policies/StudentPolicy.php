<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class StudentPolicy
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

        return $user->hasAnyPermission(['Admission','Fees']);
        
    }

    public function create(User $user)
    {

        return $user->hasPermissionTo('Admission');
        
    }

    public function update(User $user)
    {

        return $user->hasPermissionTo('Admission');
        
    }

    public function delete(User $user)
    {

        return $user->hasPermissionTo('Admission');
        
    }

}
