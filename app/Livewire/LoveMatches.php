<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Like;

class LoveMatches extends Component
{
    public string $tab = 'match';
    public array $users = [
        'all'       => [],
        'like'      => [],
        'likeSent'  => [],
        'dislike'   => [],   // added
        'match'     => [],
    ];


    public function mount()
    {
        $me = Auth::user();

        $all      = User::where('id', '!=', $me->id)->get();
        $received = $me->likesReceived()->pluck('user_id')->toArray();
        $sent     = $me->likesGiven()->pluck('target_user_id')->toArray();
        $disliked = $me->dislikesGiven()->pluck('target_user_id')->toArray();  // fetch
        $mutual   = array_intersect($received, $sent);

        $this->users['all']       = $all;
        $this->users['like']      = User::whereIn('id', $received)->get();
        $this->users['likeSent']  = User::whereIn('id', $sent)->get();
        $this->users['dislike']   = User::whereIn('id', $disliked)->get();       // assign
        $this->users['match']     = User::whereIn('id', $mutual)->get();
    }

    public function setTab(string $tab)
    {
        $this->tab = $tab;
    }

    public function react(int $targetId, string $type)
    {
        $me = Auth::user();

        Like::updateOrCreate(
            ['user_id' => $me->id, 'target_user_id' => $targetId],
            ['type'    => $type]
        );

        // Refresh the component from the front-end side
        $this->dispatch('reload');
    }

    public function render()
    {
        return view('livewire.love-matches')->layout('layouts.app');
    }
}
