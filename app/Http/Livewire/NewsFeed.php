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
        $this->like = Like::class;
    }

    public function toggleLike(Post $post)
    {
        $this->post = $this->selectedPost;

        if (auth()->user()) {
            if ($this->like) {
                $this->like->delete();
                $this->like = false;
            } else {
                $this->like = Like::create([
                    'post_id' => $post->id,
                    'user_id' => auth()->id(),
                    'liked' => 0,
//                    $this->post->likes()->toggle(auth()->id())
                ]);
            }
            $this->emitSelf('refresh');
        } else {
            $this->redirect('/login');
        }

    }

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('comments.creator')
                ->with('likes')->latest()->get(),
        ]);
    }
}
