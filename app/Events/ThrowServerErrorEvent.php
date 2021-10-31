<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThrowServerErrorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
