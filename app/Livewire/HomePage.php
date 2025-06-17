<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Like;
use App\Models\Notification;

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
            ->whereDoesntHave('likedBy', fn($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(1, ['*'], 'page', $this->page);

        $currentUser = $users->first();

        if ($currentUser) {
            $me = auth()->user();

            Like::updateOrCreate(
                ['user_id' => $me->id, 'target_user_id' => $currentUser->id],
                ['type' => $type]
            );

            if ($type === 'like') {
                $alreadyLikedMe = Like::where('user_id', $currentUser->id)
                                      ->where('target_user_id', $me->id)
                                      ->where('type', 'like')
                                      ->exists();

                $notifType = $alreadyLikedMe ? 'match' : 'like';

                Notification::create([
                    'user_id' => $currentUser->id,
                    'from_user_id' => $me->id,
                    'type' => $notifType,
                ]);
            }
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
