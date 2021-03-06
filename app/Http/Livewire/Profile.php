<?php

namespace App\Http\Livewire;

use App\Models\Followable;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads, Followable;

    public $post;
    public $like;
    public $editing;
    public $newAvatar;
    public User $user;
    public $search = '';
    public $selectedPost;
    public $showEditModal = false;
    public $showPostModal = false;
    public $showCreateModal = false;
    public $dispatchBrowserEvent;

    protected $rules = [
        'editing.title' => 'required',
        'editing.description' => 'required',
        'newAvatar' => 'nullable|image',
        'selectedPost.image' => 'required',
        'selectedPost.description' => 'required',
    ];

    protected $listeners = ['showCreateModal' => 'create', 'refresh' => '$refresh'];

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

        $this->dispatchBrowserEvent('event-notification', [
           'eventName' => 'Success',
           'eventMessage' => 'You have a sample event notification',
        ]);
    }

    public function save()
    {
        $this->validate();

        if ($this->selectedPost) {
            $filename = $this->selectedPost['image']->store('/', 'avatars');

            $this->user->avatar = $filename;

            $this->user->save();
        }

//        if ($this->newAvatar) {
//            $filename = $this->newAvatar->store('/', 'avatars');
//
//            $this->user->avatar = $filename;
//
//            $this->user->save();
//        }

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function makeBlankPost(){ return Post::make(); }

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

    /**
     * If the user is currently following
     *
     * @param User $user
     */
    public function followUser(User $user)
    {
        auth()->user()->toggleFollow($user);
    }

    public function toggleLike()
    {
        if (auth()->user()) {
            if ($this->like) {
                $this->like->delete();
                $this->like = false;
            } else {
                $this->like = Like::create([
                    'post_id' => $this->selectedPost->id, 'user_id' => auth()->id(), 'liked' => 0
                ]);
            }
            $this->emitSelf('refresh');
        } else {
            $this->redirect('/login');
        }

    }

    public function newPost()
    {
        $this->validate([
            'selectedPost.image' => 'required',
            'selectedPost.description' => 'required',
        ]);

//       $image =  $this->post['image']->store('/', 'posts');
        $image =  $this->selectedPost['image']->store('/', 'posts');

        $post = new Post;

        $post->image = basename($image);
        $post->caption = $this->selectedPost['description'];
        $post->user_id = $this->user->id;
        $post->tags()->attach(request('tags'));

        if(request('tag')) {
            $description = Tag::where('name', request('tag'))->firstOrFail()->posts;
            return $description;
        }

        $post->save();

        if(preg_match_all("/#(\w+)/", $post->caption, $matches, PREG_PATTERN_ORDER)) {
            foreach($matches[1] as $word) {
                $tag = Tag::where('name', $word)->first();
                if(!tag) {
                    $tag = Tag::updateOrCreate(['name' => $word]);
                }

                $post->tags()->attach(request('tags'));
            }
        }

//        if(Str::contains($post->caption, '#')){
//            preg_match("/#(\w+)/", $post->caption, $matches);
//            $hash = $matches[1];
//            Tag::create(['name' => $hash]);
//        }

        $this->showCreateModal = false;
    }

    /**
     * Dispatch Event
     */
    public function dispatchEvent()
    {
        $this->dispatchBrowserEvent('event-notification', [
            //array of data to pass to js callback function (event name & message)
            'eventName' => 'Success',
            'eventMessage' =>'You have a sample event notification'
        ]);
    }

    public function render()
    {
//        $this->user = User::where('id', $this->user->id)->with('posts')->firstOrFail();
        $this->user = User::findOrFail($this->user->id);
        $this->user->load('posts');

        return view('livewire.profile', [
            'users' => User::with('comments')->get(),
        ]);
    }

}
