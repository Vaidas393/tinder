<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Conversation;
use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;

class ChatBox extends Component
{
    public Conversation $conversation;
    public $messages;
    public $newMessage = '';
    public $editingMessageId = null;
    public $editingMessageText = '';

    protected $listeners = ['message-received' => 'refreshMessages'];

    public function mount(Conversation $conversation)
    {
        $this->conversation = $conversation;
        $this->loadMessages();
        $this->markMessagesAsRead();
    }

    public function loadMessages()
    {
        $this->messages = $this->conversation->messages()->with('sender')->get();
    }

    public function markMessagesAsRead()
    {
        Message::where('conversation_id', $this->conversation->id)
            ->where('sender_id', '!=', Auth::id())
            ->where('read', false)
            ->update(['read' => true, 'read_at' => now()]);
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) === '') return;

        $message = Message::create([
            'conversation_id' => $this->conversation->id,
            'sender_id' => Auth::id(),
            'body' => $this->newMessage,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->newMessage = '';
        $this->loadMessages();
    }

    public function refreshMessages()
    {
        $this->loadMessages();
        $this->markMessagesAsRead();
    }

    public function startEditing($messageId)
    {
        $message = Message::find($messageId);
        if ($message && $message->sender_id === Auth::id()) {
            $this->editingMessageId = $message->id;
            $this->editingMessageText = $message->body;
        }
    }

    public function cancelEditing()
    {
        $this->editingMessageId = null;
        $this->editingMessageText = '';
    }

    public function updateMessage()
    {
        $message = Message::find($this->editingMessageId);
        if ($message && $message->sender_id === Auth::id()) {
            $message->update([
                'body' => $this->editingMessageText,
                'is_edited' => true,
            ]);
        }
        $this->cancelEditing();
        $this->loadMessages();
    }

    public function deleteMessage($messageId)
    {
        $message = Message::find($messageId);
        if ($message && $message->sender_id === Auth::id()) {
            $message->delete();
        }
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat-box')->layout('layouts.app');
    }
}
