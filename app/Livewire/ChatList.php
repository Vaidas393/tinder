<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversation;
use App\Models\Message;

class ChatList extends Component
{
    public $conversations = [];

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $userId = Auth::id();

        $this->conversations = Conversation::with(['userOne', 'userTwo', 'messages' => fn ($q) => $q->latest()->take(1)])
            ->where(function ($query) use ($userId) {
                $query->where('user_one_id', $userId)
                      ->orWhere('user_two_id', $userId);
            })
            ->latest('updated_at')
            ->get();
    }

    public function getOtherUser($conversation)
    {
        return Auth::id() === $conversation->user_one_id
            ? $conversation->userTwo
            : $conversation->userOne;
    }

    public function unreadCount($conversation)
    {
        return Message::where('conversation_id', $conversation->id)
            ->where('sender_id', '!=', Auth::id())
            ->where('read', false)
            ->count();
    }

    public function render()
    {
        return view('livewire.chat-list')->layout('layouts.app');
    }
}
