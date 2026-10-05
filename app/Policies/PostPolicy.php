<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    // Admin boleh semua. Editor hanya boleh post miliknya sendiri.
    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || ($user->isEditor() && $user->id === $post->user_id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}