<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Collection;
use Livewire\Component;


class ChatMessages extends Component
{
    public $messages;
    public $chatId;

    protected $listeners = [
        'chatSelected' => 'chatSelected',
    ];

    public function mount(Collection $messages)
    {
        $this->messages = $messages;
    }

    public function getListeners()
    {
        return [
            'message.created' => 'prependMessage'
        ];
    }

    public function prependMessage($id)
    {
        //access messages collection
        $this->messages->prepend(Message::find($id));
    }

    public function chatSelected($chatId)
    {
        dd($chatId);
        $this->chatId = $chatId;
    }

    public function render()
    {
        return view('livewire.chat.chat-messages', [
            'messages' => Message::where('chat_id', $this->chatId)->latest()->get(),
        ]);
    }
}
