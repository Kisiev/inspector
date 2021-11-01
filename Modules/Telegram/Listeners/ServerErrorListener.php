<?php

namespace Modules\Telegram\Listeners;

use App\Events\ThrowServerErrorEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Telegram\Services\Bot\ClientBot;
use Modules\Telegram\Services\Bot\SendMessageInterface;

class ServerErrorListener implements ShouldQueue
{
    private SendMessageInterface $bot;

    public function __construct(SendMessageInterface $bot)
    {
        $this->bot = $bot;
    }
    
    public function handle(ThrowServerErrorEvent $event)
    {
        $this->bot->sendMessage(env('TELEGRAM_REPORT_CHAT'), $event->message);
    }
}
