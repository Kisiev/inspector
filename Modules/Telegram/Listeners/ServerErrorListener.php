<?php

namespace Modules\Telegram\Listeners;

use App\Events\ThrowServerErrorEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Telegram\Services\Bot\ClientBot;

class ServerErrorListener implements ShouldQueue
{
    public function handle(ThrowServerErrorEvent $event)
    {
        // TODO
        app(ClientBot::class)->sendMessage(env('TELEGRAM_REPORT_CHAT'), $event->content);
    }
}
