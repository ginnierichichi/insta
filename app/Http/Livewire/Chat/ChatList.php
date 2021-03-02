<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChatList extends Component
{
    public function render()
    {
        return view('livewire.chat.chat-list', [
            'chats' => Message::with('users')->get(),
        ]);
    }
}
