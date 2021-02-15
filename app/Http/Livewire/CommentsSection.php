<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsSection extends Component
{
    use WithPagination;


    public $newComment;
    public User $user;

    public function mount()
    {
        $initialComments = Comment::latest()->paginate(2);

        $this->comments = $initialComments;
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required',
        ]);

        $createdComment = Comment::create([
            'content' => $this->newComment,
            'user_id' => $this->user->username,
            'post_id' => 1,
            ]);

        $this->comments->prepend($createdComment);

        $this->newComment = "";
    }

    public function render()
    {
        return view('livewire.comments-section', [
            'comments' => Comment::all(),
        ]);
    }
}
