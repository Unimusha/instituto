<?php

namespace App\Policies;

use App\Centro;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class CentroPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any centros.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function view(?User $user, Centro $centro)
    {
        return true;
    }

    /**
     * Determine whether the user can create centros.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function update(User $user, Centro $centro)
    {
        return $user->id === $centro->coordinador
            ? Response::allow()
            : Response::deny('You do not own this centro.');
    }

    /**
     * Determine whether the user can delete the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function delete(User $user, Centro $centro)
    {
        return $user->id === $centro->coordinador
            ? Response::allow()
            : Response::deny('You do not own this centro.');
    }

    /**
     * Determine whether the user can restore the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function restore(User $user, Centro $centro)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function forceDelete(User $user, Centro $centro)
    {
        //
    }

    
    /**
     * Determine whether the user can permanently delete the centro.
     *
     * @param  \App\User  $user
     * @param  \App\Centro  $centro
     * @return mixed
     */
    public function verificado(User $user, Centro $centro)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
    
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }
}
