<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Trust;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrustPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the trust can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list trusts');
    }

    /**
     * Determine whether the trust can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trust  $model
     * @return mixed
     */
    public function view(User $user, Trust $model)
    {
        return $user->hasPermissionTo('view trusts');
    }

    /**
     * Determine whether the trust can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create trusts');
    }

    /**
     * Determine whether the trust can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trust  $model
     * @return mixed
     */
    public function update(User $user, Trust $model)
    {
        return $user->hasPermissionTo('update trusts');
    }

    /**
     * Determine whether the trust can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trust  $model
     * @return mixed
     */
    public function delete(User $user, Trust $model)
    {
        return $user->hasPermissionTo('delete trusts');
    }

    /**
     * Determine whether the trust can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trust  $model
     * @return mixed
     */
    public function restore(User $user, Trust $model)
    {
        return false;
    }

    /**
     * Determine whether the trust can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trust  $model
     * @return mixed
     */
    public function forceDelete(User $user, Trust $model)
    {
        return false;
    }
}
