<?php

namespace Modules\Notification\Listeners;

use Modules\Notification\Events\EmailSendEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Notification\Services\EmailSendInterface;

class EmailSendListener implements ShouldQueue
{
    private EmailSendInterface $emailSendService;

    public function __construct(EmailSendInterface $emailSendService)
    {
        $this->emailSendService = $emailSendService;
    }
    
    /**
     * Handle the event.
     *
     * @param  EmailSendEvent  $event
     * @return void
     */
    public function handle(EmailSendEvent $event)
    {
        $this->emailSendService->send($event->email, $event->message);
    }
}
