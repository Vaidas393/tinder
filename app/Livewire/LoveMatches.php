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

    public array $page = [
        'all' => 1,
        'like' => 1,
        'likeSent' => 1,
        'dislike' => 1,
        'match' => 1,
    ];
    public int $perPage = 10;
    public bool $hasMore = true;
    public bool $reacting = false;

    public function mount(): void
    {
        $this->tab = session('current_tab', 'match');
        $this->users = [
            'all' => [],
            'like' => [],
            'likeSent' => [],
            'dislike' => [],
            'match' => [],
        ];
        $this->page = [
            'all' => 1,
            'like' => 1,
            'likeSent' => 1,
            'dislike' => 1,
            'match' => 1,
        ];
        $this->loadUsers(true);
    }

    public function setTab(string $tab): void
    {
        $this->tab = $tab;
        session()->put('current_tab', $tab);
        $this->page[$tab] = 1;
        $this->users[$tab] = [];
        $this->hasMore = true;
        $this->loadUsers(true);
        // Always refresh all tabs to ensure consistency
        foreach (['all', 'like', 'likeSent', 'dislike', 'match'] as $refreshTab) {
            if ($refreshTab !== $tab) {
                $this->page[$refreshTab] = 1;
                $this->users[$refreshTab] = [];
            }
        }
    }

    public function loadUsers($reset = false): void
    {
        $me = Auth::user();
        if (!$me) return;
        $perPage = $this->perPage;
        $page = $this->page[$this->tab];
        $query = User::query();
        if ($this->tab === 'all') {
            $query->where('id', '!=', $me->id);
        } elseif ($this->tab === 'like') {
            $ids = array_filter($me->likesReceived()->pluck('user_id')->all());
            $query->whereIn('id', $ids ?: [0]);
        } elseif ($this->tab === 'likeSent') {
            $ids = array_filter($me->likesGiven()->pluck('target_user_id')->all());
            $query->whereIn('id', $ids ?: [0]);
        } elseif ($this->tab === 'dislike') {
            $ids = array_filter($me->dislikesGiven()->pluck('target_user_id')->all());
            $query->whereIn('id', $ids ?: [0]);
        } elseif ($this->tab === 'match') {
            $received = array_filter($me->likesReceived()->pluck('user_id')->all());
            $sent = array_filter($me->likesGiven()->pluck('target_user_id')->all());
            $mutual = array_values(array_intersect($received, $sent));
            $query->whereIn('id', $mutual ?: [0]);
        }
        $users = $query->paginate($perPage, ['*'], 'page', $page);
        if ($reset) {
            $this->users[$this->tab] = $users->items();
        } else {
            $this->users[$this->tab] = array_merge($this->users[$this->tab], $users->items());
        }
        $this->hasMore = $users->hasMorePages();
    }

    public function loadMore()
    {
        $this->page[$this->tab]++;
        $this->loadUsers();
    }

    public function react(int $targetId, string $type): void
    {
        if ($this->reacting) return;
        $this->reacting = true;

        $me = Auth::user();
        if (!$me || $me->id === $targetId || !in_array($type, ['like', 'dislike'])) {
            $this->reacting = false;
            return;
        }

        Like::updateOrCreate(
            ['user_id' => $me->id, 'target_user_id' => $targetId],
            ['type' => $type]
        );

        $isMutualLike = false;
        if ($type === 'like') {
            $isMutualLike = Like::where('user_id', $targetId)
                ->where('target_user_id', $me->id)
                ->where('type', 'like')
                ->exists();
            Notification::create([
                'user_id'      => $targetId,
                'from_user_id' => $me->id,
                'type'         => $isMutualLike ? 'match' : 'like',
            ]);
        }

        // Always refresh all tabs to ensure UI is up-to-date
        foreach (['all', 'like', 'likeSent', 'dislike', 'match'] as $tab) {
            $this->page[$tab] = 1;
            $this->users[$tab] = [];
        }
        $this->hasMore = true;
        $this->loadUsers(true);

        $this->reacting = false;
    }

    public function startChat(int $otherId)
    {
        $me = Auth::id();
        if ($me === $otherId) return;

        // Check if a chat already exists (either direction)
        $chat = \App\Models\Chat::where(function($q) use ($me, $otherId) {
            $q->where('sender_id', $me)->where('receiver_id', $otherId);
        })->orWhere(function($q) use ($me, $otherId) {
            $q->where('sender_id', $otherId)->where('receiver_id', $me);
        })->first();

        // If no chat exists, create a new one (with empty message)
        if (!$chat) {
            $chat = \App\Models\Chat::create([
                'sender_id' => $me,
                'receiver_id' => $otherId,
                'message' => '',
            ]);
        }

        // Redirect to chat box route (by user id)
        return redirect()->route('chat.box', ['user' => $otherId]);
    }

    public function render()
    {
        return view('livewire.love-matches')->layout('layouts.app');
    }
}
