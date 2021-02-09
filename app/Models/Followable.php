<?php


namespace App\Models;


trait Followable
{

    public function following(User $user)
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->exists();
    }

    public function follow(User $user)
    {
        return $this->follows()->save($user);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
}
