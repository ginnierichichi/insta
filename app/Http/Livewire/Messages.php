<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;

class Messages extends Component
{
    public $chats;
    public $messages;

    public function mount(Collection $chats)
    {
        $this->chats = $chats;
    }

    public function render()
    {
        return view('livewire.messages', [
            'messages' => Message::with('users'),
        ]);
    }
}
