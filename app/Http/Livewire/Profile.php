<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Followable;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $post;
    public $editing;
    public $newAvatar;
    public User $user;
    public $search = '';
    public $showEditModal = false;
    public $showCreateModal = false;


    protected $rules = [
      'editing.title' => 'required',
      'editing.description' => 'required',
      'newAvatar' => 'nullable|image',
    ];

    public function mount(User $user)
    {
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

    public function followUser(User $user)
    {
//        dd($user);

        if(!in_array($user->id, auth()->user()->follows->toArray())) {
            Follow::create(['user_id' => auth()->id(), 'following_user_id' => $user->id]);
        } else {
            auth()->user()->follows()->delete();
        }

        return back();
    }

    public function newPost()
    {
        $this->validate([
            'post.image' => 'required',
            'post.description' => 'required',
        ]);

       $image =  $this->post['image']->store('/', 'posts');

        $post= new Post;

        $post->image = $image;
        $post->caption = $this->post['description'];
        $post->user_id =$this->user->id;

        $post->save();

        $this->showCreateModal = false;
    }

    public function render()
    {
//        $this->user = User::where('id', $this->user->id)->with('posts')->firstOrFail();
        $this->user = User::findOrFail($this->user->id);
        $this->user->load('posts');

        dd(in_array($this->user->id, auth()->user()->follows->toArray()));

        return view('livewire.profile', [
            'users' => User::all(),
        ]);
    }
}
