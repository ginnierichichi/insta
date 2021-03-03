<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Livewire\Component;

class Reply extends Component
{
    public $body;
    public $chat;

    public function mount(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function reply()
    {
        $this->validate([
            'body' => 'required',
        ]);

        $message = $this->chat->messages()->create([
            'user_id' => auth()->id(),
            'body' => $this->body,
        ]);

        $this->emit('message.created', $message->id);
    }

    public function render()
    {
        return view('livewire.chat.reply');
    }
}
