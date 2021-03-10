<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function avatar()
    {
        if (!$this->avatar) {
            return asset('storage/avatars/default.png');
        }
        return asset('storage/'. $this->avatar);
    }

    public function avatarUrl()
    {
        return  $this->avatar
            ? Storage::disk('avatars')->url($this->avatar)
            : 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email)));
    }

    public function chats()
    {
        return $this->belongsToMany(Chat::class)->withPivot('read_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function inConversation($id)
    {
        return $this->chats->contains('id', $id);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedPost($post_id)
    {
        $like = Like::where('post_id', $post_id)
            ->where('user_id', auth()->user()->id)
            ->first();
        return $like ? true : false;
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->with('user');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->with('comments')->orderBy('created_at', 'desc');
    }

    public function present()
    {
        return new UserPresenter($this);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function timeline()
    {
        $friends = $this->follows()->pluck('id');

        return Post::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->withLikes()
            ->latest()->get();
    }


}
