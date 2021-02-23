<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Livewire\Component;

class Tags extends Component
{
    public $discover;
    public $user;
    public $name;
    public $like;
    public $selectedPost;
    public $showPostModal;

    protected $listeners = ['tagAdded'];

    public function mount($tag)
    {
        $this->discover = Tag::with('posts')->where('name', $tag)->get();
        $this->name = $tag;

//        $allTags = Tag:: whereName($this->tags)->first();

//        $this->tags = $allTags;     //collection of all the tags
    }

    public function hasLiked(User $user)
    {
        Like::where('user_id', $user->username)->get();
    }

    public function tagAdded($tag)
    {
        Tag::create([
            'name' => $tag
        ]);
        $this->emit('tagAddedFromBackend', $tag);
    }

    public function viewPost(Post $post)
    {
        if(checkLogin()) {
            $this->selectedPost = $post;

            $post->caption = preg_replace('/(?:^|\s)#(\w+)/','<a href="/tags/$1">#$1</a>', $post->caption);

            $like = Like::where('post_id', $this->selectedPost->id)
                ->where('user_id', auth()->user()->id)
                ->first();

            if($like){
                $this->like = $like;
            }

            //       dd($this->selectedPost['image']);
            $this->showPostModal = true;
        }
    }

    public function render()
    {
        return view('livewire.tags', [
            'taggedPosts' => Tag::with('posts')->get(),
        ]);
    }
}
