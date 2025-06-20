<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Like;
use App\Models\Notification;

class HomePage extends Component
{
    public $index = 0;
    public $availableUsers;

    public function mount()
    {
        $this->availableUsers = User::where('id', '!=', auth()->id())
            ->whereDoesntHave('likedBy', fn($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->get()
            ->values(); // Reset keys for clean indexing
    }

    public function like($type)
    {
        if (isset($this->availableUsers[$this->index])) {
            $currentUser = $this->availableUsers[$this->index];
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

            $this->index++;
        }
    }

    public function render()
    {
        $user = $this->availableUsers[$this->index] ?? null;
        return view('livewire.home-page', compact('user'))->layout('layouts.app');
    }
}
