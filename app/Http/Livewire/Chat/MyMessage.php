<?php

namespace App\Http\Livewire\Chat;

use App\Models\Message;
use Livewire\Component;

class MyMessage extends Component
{
    public Message $message;

    public function render()
    {
        return view('livewire.chat.my-message');
    }
}
