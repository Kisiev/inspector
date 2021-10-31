<?php


namespace Modules\Telegram\Services\Bot;

use TelegramBot\Api\BotApi;

class ApiBot implements SendMessageInterface, WebhookInterface
{
    private mixed $bot;

    public function __construct()
    {
        $this->bot = new BotApi(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendMessage(int $telegramId, string $message, $keyboard = null): void
    {
        $this->bot->sendMessage($telegramId, $message,null, false, null, $keyboard);
    }

    public function setWebhook(string $url): void
    {
        $this->bot->setWebhook($url);
    }

    public function deleteWebhook(): void
    {
        $this->bot->deleteWebhook();
    }
}
