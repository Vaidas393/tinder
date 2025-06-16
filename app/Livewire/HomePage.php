<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class HomePage extends Component
{
    public function render()
    {
        $users = User::where('id', '!=', auth()->id())
                     ->latest()
                     ->paginate(1);

        return view('livewire.home-page', compact('users'))
               ->layout('layouts.app');
    }
}
