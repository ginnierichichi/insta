<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ChatUsers extends Component
{
    public function render()
    {
        return view('livewire.chat.chat-users', [
            'chatUsers' => Chat::with('users')->get(),
        ]);

    }
}
