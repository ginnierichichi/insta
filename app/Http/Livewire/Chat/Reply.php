<?php

namespace App\Http\Livewire\Chat;

use App\Events\Chats\MessageAdded;
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

        $this->chat->update([
            'last_message_at' => now(),
        ]);

        foreach ($this->chat->others as $user) {
            $user->chats()->updateExistingPivot($this->chat, [
               'read_at' => null,
            ]);
        }

        broadcast(new MessageAdded($message))->toOthers();

        $this->emit('message.created', $message->id);

        $this->body = '';
    }

    public function render()
    {
        return view('livewire.chat.reply');
    }
}
