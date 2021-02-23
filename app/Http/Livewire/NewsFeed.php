<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component
{
    use WithPagination;

    public User $users;

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('comments.creator')->latest()->get(),
        ]);
    }
}
