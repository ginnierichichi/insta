<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;

class Messages extends Component
{
    public $chats;

    public function mount(Collection $chats)
    {
        $this->chats = $chats;
    }

    public function render()
    {
        return view('livewire.messages');
    }
}
