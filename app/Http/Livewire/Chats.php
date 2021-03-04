<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Chats extends Component
{
    public $chat;
    public User $user;

    public function mount($chat)
    {
        $this->chat = Message::where('id', $chat)->latest()->get();
    }
    public function render()
    {
        return view('livewire.chats', [
        'chats' => Chat::with('users')->get(),
        ]);
    }
}
