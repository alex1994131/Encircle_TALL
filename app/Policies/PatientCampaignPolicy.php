<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PatientCampaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientCampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the patientCampaign can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list patientcampaigns');
    }

    /**
     * Determine whether the patientCampaign can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientCampaign  $model
     * @return mixed
     */
    public function view(User $user, PatientCampaign $model)
    {
        return $user->hasPermissionTo('view patientcampaigns');
    }

    /**
     * Determine whether the patientCampaign can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create patientcampaigns');
    }

    /**
     * Determine whether the patientCampaign can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientCampaign  $model
     * @return mixed
     */
    public function update(User $user, PatientCampaign $model)
    {
        return $user->hasPermissionTo('update patientcampaigns');
    }

    /**
     * Determine whether the patientCampaign can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientCampaign  $model
     * @return mixed
     */
    public function delete(User $user, PatientCampaign $model)
    {
        return $user->hasPermissionTo('delete patientcampaigns');
    }

    /**
     * Determine whether the patientCampaign can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientCampaign  $model
     * @return mixed
     */
    public function restore(User $user, PatientCampaign $model)
    {
        return false;
    }

    /**
     * Determine whether the patientCampaign can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\PatientCampaign  $model
     * @return mixed
     */
    public function forceDelete(User $user, PatientCampaign $model)
    {
        return false;
    }
}
