<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class NewsFeed extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('user')->get(),
        ]);
    }
}
