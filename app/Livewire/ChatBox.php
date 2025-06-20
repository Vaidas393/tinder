<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Chat;

class ChatBox extends Component
{
    public $user;
    public $messages = [];
    public $newMessage = '';
    public $isTyping = false;
    public $showTyping = false;
    public $editingMessageId = null;
    public $editingMessageText = '';

    protected $listeners = [
        'echo-private:chat-messages,ChatMessageSent' => 'refreshMessages',
        'echo-private:chat-messages,ChatMessageUpdated' => 'refreshMessages',
        'echo-private:chat-messages,ChatMessageDeleted' => 'refreshMessages',
        'echo:chat-typing,ChatTyping' => 'showTypingIndicator',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->refreshMessages();
        $this->markAllAsRead(); // Mark as read immediately on open
    }

    public function typing()
    {
        if (!$this->isTyping) {
            $this->isTyping = true;
            broadcast(new \App\Events\ChatTyping(auth()->id(), $this->user->id))->toOthers();
        }
    }

    public function showTypingIndicator($data)
    {
        if ($data['sender_id'] == $this->user->id && $data['receiver_id'] == auth()->id()) {
            $this->showTyping = true;
            $this->dispatch('hide-typing', ['timeout' => 2000]);
        }
    }

    public function sendMessage()
    {
        $message = trim($this->newMessage);
        if ($message === '') {
            return;
        }
        $chat = Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->user->id,
            'message' => $message,
        ]);
        $this->messages->push($chat);
        $this->newMessage = '';
        $this->isTyping = false;
        broadcast(new \App\Events\ChatMessageSent($chat))->toOthers();
        $this->dispatch('refreshMessages');
        $this->dispatch('scroll-to-bottom');
    }

    public function refreshMessages($data = null)
    {
        // Only refresh if the message is for this chat
        if ($data) {
            if (
                ($data['sender_id'] == $this->user->id && $data['receiver_id'] == auth()->id()) ||
                ($data['sender_id'] == auth()->id() && $data['receiver_id'] == $this->user->id)
            ) {
                $authId = auth()->id();
                $this->messages = Chat::where(function($q) use ($authId) {
                        $q->where('sender_id', $authId)->where('receiver_id', $this->user->id);
                    })->orWhere(function($q) use ($authId) {
                        $q->where('sender_id', $this->user->id)->where('receiver_id', $authId);
                    })->orderBy('created_at')->get();
            }
        } else {
            $authId = auth()->id();
            $this->messages = Chat::where(function($q) use ($authId) {
                    $q->where('sender_id', $authId)->where('receiver_id', $this->user->id);
                })->orWhere(function($q) use ($authId) {
                    $q->where('sender_id', $this->user->id)->where('receiver_id', $authId);
                })->orderBy('created_at')->get();
        }
        $this->dispatch('scroll-to-bottom');
        $this->markAllAsRead(); // Mark as read after refreshing messages
    }

    public function startEdit($messageId, $text)
    {
        $this->editingMessageId = $messageId;
        $this->editingMessageText = $text;
    }

    public function updateMessage($messageId)
    {
        $chat = Chat::find($messageId);
        if ($chat && $chat->sender_id == auth()->id()) {
            $chat->message = $this->editingMessageText;
            $chat->save();
            $this->editingMessageId = null;
            $this->editingMessageText = '';
            broadcast(new \App\Events\ChatMessageUpdated($chat))->toOthers();
            $this->refreshMessages();
        }
    }

    public function cancelEdit()
    {
        $this->editingMessageId = null;
        $this->editingMessageText = '';
    }

    public function deleteMessage($messageId)
    {
        $chat = Chat::find($messageId);
        if ($chat && $chat->sender_id == auth()->id()) {
            $chatId = $chat->id;
            $senderId = $chat->sender_id;
            $receiverId = $chat->receiver_id;
            $chat->delete();
            broadcast(new \App\Events\ChatMessageDeleted($chatId, $senderId, $receiverId))->toOthers();
            $this->refreshMessages();
            // If no messages remain, delete conversation for both users
            $authId = auth()->id();
            $remaining = Chat::where(function($q) use ($authId) {
                $q->where('sender_id', $authId)->where('receiver_id', $this->user->id);
            })->orWhere(function($q) use ($authId) {
                $q->where('sender_id', $this->user->id)->where('receiver_id', $authId);
            })->count();
            if ($remaining === 0) {
                // Optionally, you can emit an event or redirect
                return redirect()->route('chat.list');
            }
        }
    }

    public function markAllAsRead()
    {
        $authId = auth()->id();
        $unread = Chat::where('sender_id', $this->user->id)
            ->where('receiver_id', $authId)
            ->whereNull('read_at')
            ->exists();
        if ($unread) {
            Chat::where('sender_id', $this->user->id)
                ->where('receiver_id', $authId)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
            broadcast(new \App\Events\ChatMessageUpdated(Chat::where('sender_id', $this->user->id)->where('receiver_id', $authId)->latest()->first()))->toOthers();
            $this->refreshMessages();
        }
    }

    // --- WebRTC Video Call Signaling ---
    public function startVideoCall()
    {
        // Notify the other user to prepare for a call (could be improved with user/channel targeting)
        $this->dispatch('video-offer', ['offer' => null]);
    }

    public function sendVideoOffer($offer)
    {
        $this->dispatch('video-offer', ['offer' => $offer]);
    }

    public function sendVideoAnswer($answer)
    {
        $this->dispatch('video-answer', ['answer' => $answer]);
    }

    public function sendIceCandidate($candidate)
    {
        $this->dispatch('video-ice', ['candidate' => $candidate]);
    }

    public function endVideoCall()
    {
        // Optionally notify the other user
    }

    public function render()
    {
        return view('livewire.chat-box')->layout('layouts.app');
    }
}
