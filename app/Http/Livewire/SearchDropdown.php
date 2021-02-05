<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.search-dropdown', [
            'contacts' => User::search('name', $this->search),
        ]);
    }
}
