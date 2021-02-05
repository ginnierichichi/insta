<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function selectContact($id)
    {
        $this->selectedContactId = $id;
        $this->search = '';
    }

    public function render()
    {
        $contacts = User::search('name', $this->search)->get();

        return view('livewire.search-dropdown', [
            'contacts' => $contacts,
        ]);
    }
}
