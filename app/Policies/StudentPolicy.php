<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */

    public function view(User $user)
    {

        return $user->hasPermissionTo('Fees');
        
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
