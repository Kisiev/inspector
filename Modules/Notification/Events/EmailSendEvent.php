<?php

namespace Modules\Notification\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailSendEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public string $message;
    public string $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $email, string $message = '')
    {
        $this->email = $email;
        $this->message = $message;
    }
}
