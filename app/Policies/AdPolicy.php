<?php

namespace App\Policies;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdPolicy extends CheckAccess
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
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Ad $ad)
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
        return $this->checkAccess($user,'ad_create') || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Ad $ad)
    {
        return ($user->id === $ad->user_id && $this->checkAccess($user,'ad_update')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Ad $ad)
    {
        return ($user->id === $ad->user_id && $this->checkAccess($user,'ad_delete')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Ad $ad)
    {
        return ($user->id === $ad->user_id && $this->checkAccess($user,'ad_restore')) || $this->isAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Ad $ad)
    {
        return ($user->id === $ad->user_id && $this->checkAccess($user,'ad_forceDelete')) || $this->isAdmin($user);
    }
}
