<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class HomePage extends Component
{
    public $users;

    public function mount()
    {
        // Fetch all users excluding the authenticated user
        $this->users = User::where('id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.home-page')->layout('layouts.app');
    }
}
