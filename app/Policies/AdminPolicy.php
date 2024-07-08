<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    /**
     * Determine whether the user can manage users.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function manageUsers(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can manage posts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function managePosts(User $user)
    {
        return $user->role === 'admin';
    }
}
