<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class Tags extends Component
{
    public $discover;
    public $name;

    protected $listeners = ['tagAdded'];

    public function mount($tag)
    {
        $this->discover = Tag::with('posts')->where('name', $tag)->get();
        $this->name = $tag;

//        $allTags = Tag:: whereName($this->tags)->first();

//        $this->tags = $allTags;     //collection of all the tags
    }

    public function tagAdded($tag)
    {
        Tag::create([
            'name' => $tag
        ]);
        $this->emit('tagAddedFromBackend', $tag);
    }

    public function render()
    {
        return view('livewire.tags', [
            'taggedPosts' => Tag::with('posts')->get(),
        ]);
    }
}
