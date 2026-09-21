<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ChatMessage $chatMessage)
    {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->chatMessage->chat_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'id'         => $this->chatMessage->id,
            'chat_id'    => $this->chatMessage->chat_id,
            'sender'     => $this->chatMessage->sender,
            'message'    => $this->chatMessage->message,
            'created_at' => $this->chatMessage->created_at->format('h:i A'),
        ];
    }
}
