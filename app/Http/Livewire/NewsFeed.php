<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class NewsFeed extends Component
{
    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('comments.creator')->get(),
        ]);
    }
}
