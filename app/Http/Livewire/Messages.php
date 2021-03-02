<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;

class Messages extends Component
{
    public $chats;
    public $messages;
    public $uuid;

    public function mount($message, Collection $chats)
    {
        $this->uuid = $message;

        $this->chats = $chats;
    }

    public function render()
    {
        return view('livewire.messages', [
            'messages' => Message::with('users'),
        ]);
    }
}
