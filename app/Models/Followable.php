<?php


namespace App\Models;


trait Followable
{
    public function isFollowing($user)
    {
        return $this->following()->get()->contains($user);
    }

    public function isNotFollowing()
    {
        return !$this->following()->exists();
    }

    public function toggleFollow(User $user)
    {
        if ($this->isFollowing($user)) {
            return $this->following()->detach($user);
        }

        return $this->following()->save($user);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, Follow::class, 'following_user_id', 'user_id');
    }

//    public function follows()
//    {
//        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
//    }
}
