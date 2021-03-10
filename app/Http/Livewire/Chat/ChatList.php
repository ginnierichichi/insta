<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Illuminate\Support\Collection;
use Livewire\Component;

class ChatList extends Component
{
    public $users = [];
    public $body = '';
    public $search = '';

    public function addUser($user)
    {
        dd($user);
    }

    public function render()
    {
//        $chats = request()->user()->chats();
//        $chats->updateExistingPivot($this->chat, [
//            'read_at' => now(),
//        ]);
//        $chats = $chats->orderBy('last_message_at', 'desc')->get();

        return view('livewire.chat.chat-list', [
            'chats' => Chat::with('users')
                ->with('messages')
                ->search('name', $this->search)
                ->orderBy('last_message_at', 'desc')->get(),
        ]);
    }
}
