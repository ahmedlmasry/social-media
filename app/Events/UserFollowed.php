<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserFollowed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $follower;
    public $following;

    public function __construct($follower,$following)
    {
        $this->follower = $follower;
        $this->following = $following;
    }

    public function broadcastOn():array
    {
        return [
            new PrivateChannel('user.' . $this->following->id)
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'message' => __('notifications.user_followed', ['follower' => $this->follower->username]),
            'follower' => $this->follower->only(['id', 'username', 'image'])
        ];
    }

}
