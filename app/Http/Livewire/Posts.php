<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class Posts extends Component
{

    public function exploreTag()
    {
        if(request('tag')) {
            $posts = Tag::where('name', request('tag'))->firstOrFail();
        }
        $posts = Post::latest()->get();
    }

    public function render()
    {
        return view('livewire.posts', [
            'posts' => Post::with('tag')->get(),
        ]);
    }
}
