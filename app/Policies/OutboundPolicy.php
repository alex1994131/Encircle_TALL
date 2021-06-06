<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Outbound;
use Illuminate\Auth\Access\HandlesAuthorization;

class OutboundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the outbound can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list outbounds');
    }

    /**
     * Determine whether the outbound can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Outbound  $model
     * @return mixed
     */
    public function view(User $user, Outbound $model)
    {
        return $user->hasPermissionTo('view outbounds');
    }

    /**
     * Determine whether the outbound can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create outbounds');
    }

    /**
     * Determine whether the outbound can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Outbound  $model
     * @return mixed
     */
    public function update(User $user, Outbound $model)
    {
        return $user->hasPermissionTo('update outbounds');
    }

    /**
     * Determine whether the outbound can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Outbound  $model
     * @return mixed
     */
    public function delete(User $user, Outbound $model)
    {
        return $user->hasPermissionTo('delete outbounds');
    }

    /**
     * Determine whether the outbound can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Outbound  $model
     * @return mixed
     */
    public function restore(User $user, Outbound $model)
    {
        return false;
    }

    /**
     * Determine whether the outbound can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Outbound  $model
     * @return mixed
     */
    public function forceDelete(User $user, Outbound $model)
    {
        return false;
    }
}
