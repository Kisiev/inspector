<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Notification\Events\EmailSendEvent;
use Modules\Notification\Listeners\EmailSendListener;
use Modules\Notification\Services\EmailSendInterface;
use Modules\Notification\Services\EmailSendService;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->dependencies();
        $this->registerEvents();
    }
    
    private function registerEvents(): void
    {
        Event::listen(
            EmailSendEvent::class,
            [EmailSendListener::class, 'handle']
        );
    }
    
    private function dependencies()
    {
        $this->app->instance(EmailSendInterface::class, app(EmailSendService::class));
    }
}