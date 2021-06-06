<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Keydate;
use Illuminate\Auth\Access\HandlesAuthorization;

class KeydatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the keydate can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list keydates');
    }

    /**
     * Determine whether the keydate can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Keydate  $model
     * @return mixed
     */
    public function view(User $user, Keydate $model)
    {
        return $user->hasPermissionTo('view keydates');
    }

    /**
     * Determine whether the keydate can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create keydates');
    }

    /**
     * Determine whether the keydate can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Keydate  $model
     * @return mixed
     */
    public function update(User $user, Keydate $model)
    {
        return $user->hasPermissionTo('update keydates');
    }

    /**
     * Determine whether the keydate can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Keydate  $model
     * @return mixed
     */
    public function delete(User $user, Keydate $model)
    {
        return $user->hasPermissionTo('delete keydates');
    }

    /**
     * Determine whether the keydate can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Keydate  $model
     * @return mixed
     */
    public function restore(User $user, Keydate $model)
    {
        return false;
    }

    /**
     * Determine whether the keydate can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Keydate  $model
     * @return mixed
     */
    public function forceDelete(User $user, Keydate $model)
    {
        return false;
    }
}
