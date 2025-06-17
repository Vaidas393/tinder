<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Conversation;

class LoveMatches extends Component
{
    public string $tab = 'match';

    public array $users = [
        'all'       => [],
        'like'      => [],
        'likeSent'  => [],
        'dislike'   => [],
        'match'     => [],
    ];

    public function mount(): void
    {
        $this->tab = session('current_tab', 'match');
        $this->loadUsers();
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
        session()->put('current_tab', $tab);
        $this->dispatch('reload');
        // $this->loadUsers();

    }

    public function react(int $targetId, string $type): void
    {
        $me = Auth::user();

        if (!$me || $me->id === $targetId || !in_array($type, ['like', 'dislike'])) {
            return;
        }

        // Like or Dislike the user
        Like::updateOrCreate(
            ['user_id' => $me->id, 'target_user_id' => $targetId],
            ['type' => $type]
        );

        // Only check for mutual like if this is a 'like'
        $isMutualLike = false;

        if ($type === 'like') {
            $isMutualLike = Like::where('user_id', $targetId)
                ->where('target_user_id', $me->id)
                ->where('type', 'like')
                ->exists();

            // Create notification only for 'like' or 'match'
            Notification::create([
                'user_id'      => $targetId,
                'from_user_id' => $me->id,
                'type'         => $isMutualLike ? 'match' : 'like',
            ]);
        }

        session()->put('current_tab', $this->tab);

        // Force full page reload to avoid snapshot inconsistencies
        $this->dispatch('reload');
    }

    public function loadUsers(): void
    {
        $me = Auth::user();
        if (!$me) return;

        $received = array_filter($me->likesReceived()->pluck('user_id')->all());
        $sent     = array_filter($me->likesGiven()->pluck('target_user_id')->all());
        $disliked = array_filter($me->dislikesGiven()->pluck('target_user_id')->all());
        $mutual   = array_values(array_intersect($received, $sent));

        $this->users['all']      = User::where('id', '!=', $me->id)->get();
        $this->users['like']     = $received ? User::whereIn('id', $received)->get() : collect();
        $this->users['likeSent'] = $sent ? User::whereIn('id', $sent)->get() : collect();
        $this->users['dislike']  = $disliked ? User::whereIn('id', $disliked)->get() : collect();
        $this->users['match']    = $mutual ? User::whereIn('id', $mutual)->get() : collect();
    }

    public function startChat(int $otherId): void
    {
        $me = Auth::id();

        // Prevent chat with self
        if ($me === $otherId) return;

        // Check if a conversation already exists
        $conversation = Conversation::where(function ($query) use ($me, $otherId) {
            $query->where('user_one_id', $me)->where('user_two_id', $otherId);
        })->orWhere(function ($query) use ($me, $otherId) {
            $query->where('user_one_id', $otherId)->where('user_two_id', $me);
        })->first();

        // If not found, create new conversation
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one_id' => $me,
                'user_two_id' => $otherId,
            ]);
        }

        // Redirect to chat box
        redirect()->route('chat.box', ['conversation' => $conversation->id]);
    }

    public function render()
    {
        return view('livewire.love-matches')->layout('layouts.app');
    }
}
