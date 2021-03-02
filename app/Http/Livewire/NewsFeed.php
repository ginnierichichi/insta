<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Likeable;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class NewsFeed extends Component
{
    use WithPagination, Likeable;

    public $like;
    public $user;
    public $post;
    public $selectedPost;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount(User $user)
    {
        $this->user = $user->load('posts');
    }

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('comments.creator')
                ->with('likes')->latest()->get(),
        ]);
    }
}
