<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChatList extends Component
{
    public function render()
    {
        return view('livewire.chat.chat-list', [
            'chats' => Chat::with('users')->get(),
        ]);
    }
}
