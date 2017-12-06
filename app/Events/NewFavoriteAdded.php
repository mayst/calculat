<?php

namespace App\Events;

use App\User;
use DateTime;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewFavoriteAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $name;
    private $link;
    private $age;
    private $avatar;
    private $type;
    private $receiver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, User $receiver)
    {
        $this->name = $user->name;
        $this->avatar = $user->avatar();
        $info = $user->info;
        $this->link = '/profile/' . $info->id;
        $now  = new DateTime();
        $this->age = $now->diff($info->age)->y;
        $this->type = 'favorite';
        $this->receiver = $receiver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return [
            $this->receiver
        ];
    }

    public function broadcastAs()
    {
        return 'favorite';
    }
}
