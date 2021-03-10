<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;


class ChatMessages extends Component
{
    public $messages;
    public $chatId;

    public function mount(Chat $chat)
    {
        $this->chatId = $chat->id;
    }

    public function getListeners()
    {
        return [
            'message.created' => 'prependMessage',
            "echo-private:chats.{$this->chatId},Chats\\MessageAdded" => 'prependMessageFromBroadcast',
        ];
    }

    public function prependMessage($id)
    {
        //access messages collection
        $this->messages->push(Message::find($id));
    }

    public function prependMessageFromBroadcast($payload)
    {
        dd($payload);
        $this->prependMessage($payload['message']['id']);
    }

    public function render()
    {
        return view('livewire.chat.chat-messages');
    }
}
