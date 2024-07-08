<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class UserPolicy
{
    /**
     * Determine whether the user can manage the given post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return mixed
     */
    public function manage(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
