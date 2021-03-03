<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;


class ChatMessages extends Component
{
    public $messages;

    public function mount(Collection $messages)
    {
        $this->messages = $messages;
    }

    public function render()
    {
        return view('livewire.chat.chat-messages');
    }
}
