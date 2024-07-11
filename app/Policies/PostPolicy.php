<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /**
     * Determine whether the user can view any models.
     */


    public function update(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): Response
    {
        return $user->id === $post->user_id ? Response::allow() : Response::deny();
    }

}
