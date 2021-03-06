<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsSection extends Component
{
    use WithPagination;

    public Post $post;

    public $newComment;
    public User $user;
    public array $comments;
    public $amount = 2;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    protected $rules = [
        'newComment' => 'required',
    ];


//    public function mount()
//    {
//        $initialComments = Comment::latest()->paginate(2);
//        $this->comments = $initialComments;
//    }

    public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate();

        $createdComment = Comment::create([
            'content' => $this->newComment,
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            ]);


//        $this->comments->prepend($createdComment);

        $this->newComment = "";

        $this->post = Post::find($this->post->id);
    }

    public function loadMore()
    {
        $this->amount = $this->amount + 3;
    }

    public function render()
    {
        $comments = Comment::latest()->paginate($this->amount);
//        $this->emit('userStore');

        return view('livewire.comments-section', [
            'comments' => $comments,
        ]);

    }
}
