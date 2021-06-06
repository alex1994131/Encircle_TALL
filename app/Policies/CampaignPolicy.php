<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the campaign can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list campaigns');
    }

    /**
     * Determine whether the campaign can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Campaign  $model
     * @return mixed
     */
    public function view(User $user, Campaign $model)
    {
        return $user->hasPermissionTo('view campaigns');
    }

    /**
     * Determine whether the campaign can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create campaigns');
    }

    /**
     * Determine whether the campaign can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Campaign  $model
     * @return mixed
     */
    public function update(User $user, Campaign $model)
    {
        return $user->hasPermissionTo('update campaigns');
    }

    /**
     * Determine whether the campaign can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Campaign  $model
     * @return mixed
     */
    public function delete(User $user, Campaign $model)
    {
        return $user->hasPermissionTo('delete campaigns');
    }

    /**
     * Determine whether the campaign can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Campaign  $model
     * @return mixed
     */
    public function restore(User $user, Campaign $model)
    {
        return false;
    }

    /**
     * Determine whether the campaign can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Campaign  $model
     * @return mixed
     */
    public function forceDelete(User $user, Campaign $model)
    {
        return false;
    }
}
