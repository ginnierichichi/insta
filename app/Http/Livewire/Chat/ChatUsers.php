<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ChatUsers extends Component
{
    public $users;

    public function mount(Collection $users)
    {
        $this->users = $users;
    }

    public function render()
    {
        return view('livewire.chat.chat-users', [
            'users' => Chat::with('users')->get(),
        ]);
    }
}
