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

    public function toggleLike()
    {
//        if (auth()->user()) {
//            if ($this->like) {
//                $this->like->delete();
//                $this->like = false;
//            } else {
//                $this->like = Like::create([
////                    dd($this->post),
//                    $this->post->likes()->toggle(auth()->id())
////                    'post_id' => $this->post->id, 'user_id' => auth()->id(), 'liked' => 0
//                ]);
//            }
//            $this->emitSelf('refresh');
//        } else {
//            $this->redirect('/login');
//        }

        $this->post->likes()->toggle(auth()->id());

    }

    public function render()
    {
        return view('livewire.news-feed', [
            'posts' => Post::with('comments.creator')->latest()->get(),
        ]);
    }
}
