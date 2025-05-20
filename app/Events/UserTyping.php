<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function broadcastOn(): array
    {
        return [new Channel('chat')]; // Public channel
    }

    public function broadcastWith()
    {
        return ['username' => $this->user];
    }

    // Optional if you want to customize the event name
    public function broadcastAs()
    {
        return 'user.typing';
    }
}
