<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function postsUrl()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->email)));
    }
}
