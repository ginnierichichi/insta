<?php

namespace App\Http\Livewire;

use App\Models\Followable;
use App\Models\User;
use Livewire\Component;

class FriendsList extends Component
{
    use Followable;
    public $user;
    public $slug;

//    public function mount(User $url)
//    {
//        $this->user = User::where('username', $url)->get();
//        $this->slug= $url;
//    }

    public function followUser(User $user)
    {
        auth()->user()->toggleFollow($user);
    }

    public function render()
    {
        return view('livewire.friends-list', [
            'users' => User::where('id', '!=', auth()->id())->get()
            ]);
    }
}
