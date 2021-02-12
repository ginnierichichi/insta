<?php

namespace App\Http\Livewire;

use App\Models\Followable;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, Followable;

//    These are the public variables
    public $like;
    public Post $post;
    public Post $editing;
    public $newAvatar;
    public User $user;
    public $search = '';
    public Post $selectedPost;
    public $showEditModal = false;
    public $showPostModal = false;
    public $showCreateModal = false;


    protected $rules = [
        'editing.title' => 'required',
        'editing.description' => 'required',
        'newAvatar' => 'nullable|image',
    ];

    // Listeners listen for an $emit (from blade or another component)
    // or $emitSelf right from this page
    // when it hears the emit (first in array, in this case refresh) it will do the function (second in array)
    // in this case it will just do $refresh which refreshes the component

    protected $listeners = ['refresh', '$refresh'];

    public function mount(User $user)
    {
        $this->post = $this->makeBlankPost();
        $this->user = $user->load('posts');
    }

    public function edit(\App\Models\Profile $bio)
    {
        $this->resetErrorBag();
        $this->editing = $bio;
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->resetErrorBag();
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();


        if ($this->newAvatar) {
            $filename = $this->newAvatar->store('/', 'avatars');

            $this->user->avatar = $filename;

            $this->user->save();
        }


        $this->editing->save();

        $this->showEditModal = false;

//        $this->showEdotoModal = false;
    }

    public function makeBlankPost()
    {
        return Post::make();
    }

    /**
     * @param  Post  $post
     * get the id from the clicked post and put it in the selectedPost variable
     *
     * Look in the Like database, if the auth user has liked this selected post add it to the public $like variable
     * If we don't find a like we want like to be false so the modal hearts are not red
     */
    public function viewPost(Post $post)
    {
        $this->selectedPost = $post;

        $this->like = Like::where('post_id', $this->selectedPost->id)
                ->where('user_id', auth()->user()->id)
                ->first() ?? false;

        $this->showPostModal = true;
    }

    /**
     * If the user is currently following
     *
     * @param  User  $user
     */
    public function followUser(User $user)
    {
        auth()->user()->toggleFollow($user);
    }

    public function newPost()
    {
        $this->validate([
            'post.image' => 'required',
            'post.description' => 'required',
        ]);

        $image = $this->post['image']->store('/', 'posts');

        $post = new Post;

        $post->image = $image;
        $post->caption = $this->post['description'];
        $post->user_id = $this->user->id;

        $post->save();

        $this->showCreateModal = false;
    }

    /**
     * @throws \Exception
     *
     * If we found a like and it is in the public variable the hearts are red, when we click it to dislike it we will
     * delete it and turn the hearts err not red :D
     * We also toggle the public $like to false so that the modal heart is also not red :P
     *
     * If we didn't find a like we made the public $like variable false which means the heart is not red, but as we
     * clicked it we want it red so we create a like and add it into the public like variable which toggles the heart to red
     */
    public function toggleLike()
    {
        if ($this->like) {
            $this->like->delete();
            $this->like = false;
        } else {
            $this->like = Like::create(['post_id' => $this->selectedPost->id, 'user_id' => auth()->id(), 'liked' => 0]);
        }

        //tells the component to run the listener for refresh
        $this->emitSelf('refresh');
    }

    public function render()
    {
//        $this->user = User::where('id', $this->user->id)->with('posts')->firstOrFail();
        $this->user = User::findOrFail($this->user->id);
        $this->user->load('posts');

        return view('livewire.profile', [

            'users' => User::all(),
        ]);
    }
}
