<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class NewsFeed extends Component
{
    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => User::all(),
        ]);
    }
}
