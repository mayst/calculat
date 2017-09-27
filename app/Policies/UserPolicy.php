<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*public function before(User $user, $ability, User $item)
    {
        return true;
    }*/

    public function display(User $user, User $item)
    {
        return true;
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function create(User $user, User $item)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function edit(User $user, User $item)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function delete(User $user, User $item)
    {
        return $user->role == 'admin';
    }

    /**
     * @param User $user
     * @param User $item
     *
     * @return bool
     */
    public function restore(User $user, User $item)
    {
        return true;
    }
}
