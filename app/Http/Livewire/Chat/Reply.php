<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\Message;
use Livewire\Component;

class Reply extends Component
{
    public $body = '';
    public Chat $chat;

    public function reply()
    {
        $this->validate([
            'body' => 'required',
        ]);

        $message = $this->chat->messages()->create([
            'user_id' => auth()->id(),
            'chat_id' => $this->chat->id,
            'body' => $this->body,
        ]);

        $this->emit('message.created', $message->id);

        $this->body = '';
    }

    public function render()
    {
        return view('livewire.chat.reply');
    }
}
