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
    public $selectedChat = false;

    public function mount($chat = null)
    {
        $this->selectedChat = $this->user->chats->filter( function ($value) use ($chat) {
            return $value->uuid === $chat;
        })->first();

        // can do this way, but will double hits to the database, slowing it down.
//        $this->selectedChat = Chat::with('messages')->where('uuid', $chat)->first();
    }
    public function render()
    {
        return view('livewire.chats');
    }
}
