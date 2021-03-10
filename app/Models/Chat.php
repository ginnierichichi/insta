<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_message_at'
    ];

    protected $dates = [
      'last_message_at',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getReadAttribute() {

        return $this->chats->read();
    }

    public function read()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('read_at');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at' );
    }

    public function others()
    {
        return $this->users()->where('user_id', '!=', auth()->id());
    }
}
