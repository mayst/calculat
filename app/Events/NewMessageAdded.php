<?php

namespace App\Events;

use App\User;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessageAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;
    public $avatar;
    public $message;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->avatar = $user->avatar();
        $this->type = 'message';
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        /*$chat = [ $this->message->user_id, $this->message->receiver ];
        sort($chat);*/
        return [
            $this->message->receiver
        ];
        //            implode('.', $chat)
    }

    public function broadcastAs()
    {
        return 'message';
    }
}
