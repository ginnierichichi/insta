<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Chats extends Component
{
    public User $user;
    public $messages;

    public function mount($chat)
    {
        $this->messages = Message::where('chat_id', $chat)->latest()->get();
    }

    public function render()
    {
        return view('livewire.chats');
    }
}
