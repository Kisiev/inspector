<?php

namespace Modules\Telegram\Providers;

use App\Events\ThrowServerErrorEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Telegram\Listeners\ServerErrorListener;
use Modules\Telegram\Services\Bot\ApiBot;
use Modules\Telegram\Services\Bot\WebhookInterface;

class TelegramServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->dependencies();
        $this->registerEvents();
    }
    
    private function registerEvents(): void
    {
        Event::listen(
            ThrowServerErrorEvent::class,
            [ServerErrorListener::class, 'handle']
        );
    }

    private function dependencies()
    {
        $this->app->instance(WebhookInterface::class, app(ApiBot::class));
    }
}