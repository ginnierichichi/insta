<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $newPhoto;
    public $newAvatar;
    public User $user;
    public \App\Models\Profile $editing;
    public $showCreateModal = false;
    public $showEditModal = false;

    protected $rules = [
      'editing.title' => 'required',
      'editing.description' => 'required',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function edit(\App\Models\Profile $bio)
    {
        $this->editing = $bio;
        $this->showEditModal = true;
    }

    public function create()
    {
        $this->showCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;

        $profileData = $this->validate([
            'newAvatar' => 'image',
            'newPhoto' => 'image',
        ]);

        $filename = $this->newAvatar->store('/', 'avatars');

        $postname =  $this->newPhoto->store('/', 'posts');

        auth()->user()->update([
            'avatar' => $filename,
            'posts' => $postname
        ]);

        $this->showAvatarModal = false;
    }

    public function render()
    {
        return view('livewire.profile', [
            'users' => User::all(),
        ]);
    }
}
