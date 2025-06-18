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
        $this->loadUsers(true);
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
        $me = Auth::user();
        if (!$me || $me->id === $targetId || !in_array($type, ['like', 'dislike'])) {
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
        session()->put('current_tab', $this->tab);
        $this->page[$this->tab] = 1;
        $this->users[$this->tab] = [];
        $this->loadUsers(true);
    }

    public function startChat(int $otherId)
    {
        echo "<script>alert('hi');</script>";
        $me = Auth::id();

        // Prevent chat with self
        if ($me === $otherId) return;

        // Check if a conversation already exists
        $conversation = \App\Models\Conversation::where(function ($query) use ($me, $otherId) {
            $query->where('user_one_id', $me)->where('user_two_id', $otherId);
        })->orWhere(function ($query) use ($me, $otherId) {
            $query->where('user_one_id', $otherId)->where('user_two_id', $me);
        })->first();

        // If not found, create new conversation
        if (!$conversation) {
            $conversation = \App\Models\Conversation::create([
                'user_one_id' => $me,
                'user_two_id' => $otherId,
            ]);
        }

        $this->redirectRoute('chat.box', ['conversation' => $conversation->id]);
    }

    public function render()
    {
        return view('livewire.love-matches')->layout('layouts.app');
    }
}
