<?php

namespace App\Policies;

use App\Models\AdGet;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdGetPolicy extends CheckAccess
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdGet  $adGet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AdGet $adGet)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->checkAccess($user,'adGet_create') || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdGet  $adGet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AdGet $adGet)
    {
        return ($user->id === $adGet->user_id && $this->checkAccess($user,'adGet_update')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdGet  $adGet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AdGet $adGet)
    {
        return ($user->id === $adGet->user_id && $this->checkAccess($user,'adGet_delete')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdGet  $adGet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AdGet $adGet)
    {
        return ($user->id === $adGet->user_id && $this->checkAccess($user,'adGet_restore')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdGet  $adGet
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AdGet $adGet)
    {
        return ($user->id === $adGet->user_id && $this->checkAccess($user,'adGet_forceDelete')) || $this->isAdmin($user);
    }
}
