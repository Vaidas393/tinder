<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;
    public $senderId;
    public $receiverId;

    public function __construct($chatId, $senderId, $receiverId)
    {
        $this->chatId = $chatId;
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-messages');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->chatId,
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
        ];
    }
}
