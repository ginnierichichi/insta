<?php

namespace App\Http\Livewire\RedirectUser;

trait WithRedirect
{
    public function home()
    {
        return redirect(route( 'profile'. auth()->user()->username));
    }
}
