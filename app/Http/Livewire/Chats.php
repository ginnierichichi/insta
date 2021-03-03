<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use Illuminate\Support\Collection;
use Livewire\Component;

class Chats extends Component
{
    public $chats;
    public $messages;
    public $uuid;
    public $chat;

    public function mount($message, Collection $chats)
    {
        $this->uuid = $message;
        $this->chats = $chats;
    }

    public function render()
    {
        return view('livewire.chats', [
        'chats' => Chat::with('users')->get(),
        ]);
    }
}
