<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TestType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the testType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list testtypes');
    }

    /**
     * Determine whether the testType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TestType  $model
     * @return mixed
     */
    public function view(User $user, TestType $model)
    {
        return $user->hasPermissionTo('view testtypes');
    }

    /**
     * Determine whether the testType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create testtypes');
    }

    /**
     * Determine whether the testType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TestType  $model
     * @return mixed
     */
    public function update(User $user, TestType $model)
    {
        return $user->hasPermissionTo('update testtypes');
    }

    /**
     * Determine whether the testType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TestType  $model
     * @return mixed
     */
    public function delete(User $user, TestType $model)
    {
        return $user->hasPermissionTo('delete testtypes');
    }

    /**
     * Determine whether the testType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TestType  $model
     * @return mixed
     */
    public function restore(User $user, TestType $model)
    {
        return false;
    }

    /**
     * Determine whether the testType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TestType  $model
     * @return mixed
     */
    public function forceDelete(User $user, TestType $model)
    {
        return false;
    }
}
