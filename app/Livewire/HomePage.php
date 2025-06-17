<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Like;

class HomePage extends Component
{
    public $page = 1;

    public function mount()
    {
        $this->page = request()->get('page', 1);
    }

    public function like($type)
    {
        $users = User::where('id', '!=', auth()->id())
            ->whereDoesntHave('likedBy', function($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(1, ['*'], 'page', $this->page);
        $currentUser = $users->first();
        if ($currentUser) {
            Like::updateOrCreate([
                'user_id' => auth()->id(),
                'target_user_id' => $currentUser->id,
            ], [
                'type' => $type
            ]);
        }
        $this->page++;
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())
            ->whereDoesntHave('likedBy', function($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(1, ['*'], 'page', $this->page);
        return view('livewire.home-page', compact('users'))->layout('layouts.app');
    }
}
