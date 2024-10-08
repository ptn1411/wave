<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use TCG\Voyager\Contracts\User;
use TCG\Voyager\Policies\BasePolicy;


class CollectionPolicy extends BasePolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function edit(User $user, $pc)
    {
        return $pc->author_id === $user->id || $user->hasRole('admin');
    }

    public function delete(User $user, $pc)
    {
        return $pc->author_id === $user->id || $user->hasRole('admin');
    }

    public function read(User $user, $pc)
    {
        return $pc->author_id === $user->id || $user->hasRole('admin');
    }
}
