<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PatientMessage;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientMessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the patientMessage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list patientmessages');
    }

    /**
     * Determine whether the patientMessage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientMessage  $model
     * @return mixed
     */
    public function view(User $user, PatientMessage $model)
    {
        return $user->hasPermissionTo('view patientmessages');
    }

    /**
     * Determine whether the patientMessage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create patientmessages');
    }

    /**
     * Determine whether the patientMessage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientMessage  $model
     * @return mixed
     */
    public function update(User $user, PatientMessage $model)
    {
        return $user->hasPermissionTo('update patientmessages');
    }

    /**
     * Determine whether the patientMessage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientMessage  $model
     * @return mixed
     */
    public function delete(User $user, PatientMessage $model)
    {
        return $user->hasPermissionTo('delete patientmessages');
    }

    /**
     * Determine whether the patientMessage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientMessage  $model
     * @return mixed
     */
    public function restore(User $user, PatientMessage $model)
    {
        return false;
    }

    /**
     * Determine whether the patientMessage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientMessage  $model
     * @return mixed
     */
    public function forceDelete(User $user, PatientMessage $model)
    {
        return false;
    }
}
