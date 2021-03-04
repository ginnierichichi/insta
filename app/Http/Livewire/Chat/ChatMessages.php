<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;


class ChatMessages extends Component
{
    public $messages;

    public function getListeners()
    {
        return [
            'message.created' => 'prependMessage'
        ];
    }

    public function prependMessage($id)
    {
        //access messages collection
        $this->messages->push(Message::find($id));
    }

    public function render()
    {
        return view('livewire.chat.chat-messages');
    }
}
