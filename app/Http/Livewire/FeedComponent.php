<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class FeedComponent extends Component
{
    use WithPagination;

    public $post;
    public $like;
    public $likedBy;
    public $likesCount;

    protected $listeners = ['refresh' => '$refresh'];


    public function mount(Post $post)
    {
        $this->like = $this->post->likes->filter(function ($like) {
            return $like->user_id == auth()->id();
        })->first();

        $this->likedBy = $this->post->likes->count() > 0 ? $this->post->likes->last()->user->username : false ;

        $post->caption = preg_replace('/(?:^|\s)#(\w+)/','<a href="/tags/$1">#$1</a>', $post->caption);
    }

    public function setLikedBy()
    {
        $this->likedBy = $this->post->likes->count() > 0 ? $this->post->likes->last()->user->username : false;
        $likesCount = $this->post->likes->count();
        $this->likesCount = --$likesCount;
    }

    public function viewPost(Post $post)
    {
        $this->selectedPost = $post;



        $like = Like::where('post_id', $this->selectedPost->id)
            ->where('user_id', auth()->user()->id)
            ->first();

        if($like){
            $this->like = $like;
        }

    }

    public function toggleLike(Post $post)
    {
        // filter through all the likes for the post, find one that has the same user_id as the auth user and add it
        // to the like variable.
        // If we found a like delete it, if we didn't create one
        if ($this->like) {
            $this->like->delete();
            $this->like = false;
        } else {
            $this->like = $this->post->likes()->create(['user_id' => auth()->id(), 'liked' => 0]);
        }
        $this->emitSelf('refresh');

    }

    public function render()
    {
        return view('livewire.feed-component', [
            'likes' => Like::with('user')->get(),
        ]);
    }
}
