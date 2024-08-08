<?php

namespace App\Policies;

use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeePolicy
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
