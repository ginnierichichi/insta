<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;

trait Likeable
{
    public function scopeWithLikes(Builder $query)
    {
        $this->leftJoinSub(
            'select post_id, sun(liked) likes, sum(!liked) dislikes from likes group by post_id',
            'likes',
            'likes.post_id',
            'post_id'
        );
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like($user = null, $liked = true)
    {
        $this->likes()->updateorCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ], [
            'liked' => $liked,
        ]);
    }

    public function dislike($user = null)
    {
        return $this->like($user, false);
    }

    public function isLikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('post_id', $this->id)
            ->where('liked', true)
            ->count();
    }


    public function isDislikedBy(User $user)
    {
        return (bool)$user->likes
            ->where('post_id', $this->id)
            ->where('liked', false)
            ->count();
    }
}
