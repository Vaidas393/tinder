<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender_id;
    public $receiver_id;

    public function __construct($sender_id, $receiver_id)
    {
        $this->sender_id = $sender_id;
        $this->receiver_id = $receiver_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-typing');
    }

    public function broadcastWith()
    {
        return [
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
        ];
    }
}
