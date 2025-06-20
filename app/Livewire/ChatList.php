<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Chat;

class ChatList extends Component
{
    public $conversations = [];

    protected $listeners = [
        'echo-private:chat-messages,ChatMessageSent' => 'refreshConversations',
        'echo-private:chat-messages,ChatMessageDeleted' => 'refreshConversations',
    ];

    public function mount()
    {
        $this->loadConversations();
    }

    public function loadConversations()
    {
        $userId = auth()->id();
        $conversations = Chat::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function($chat) use ($userId) {
                return $chat->sender_id == $userId ? $chat->receiver_id : $chat->sender_id;
            });
        $this->conversations = $conversations->map(function($group) {
            return $group->all();
        })->toArray();
    }

    public function refreshConversations()
    {
        $this->loadConversations();
    }

    public function deleteConversation($userId)
    {
        $authId = auth()->id();
        Chat::where(function($q) use ($authId, $userId) {
            $q->where('sender_id', $authId)->where('receiver_id', $userId);
        })->orWhere(function($q) use ($authId, $userId) {
            $q->where('sender_id', $userId)->where('receiver_id', $authId);
        })->delete();
        $this->loadConversations();
        // Optionally broadcast a delete event if you want to update other users' lists
    }

    public function render()
    {
        return view('livewire.chat-list')->layout('layouts.app');
    }
}
