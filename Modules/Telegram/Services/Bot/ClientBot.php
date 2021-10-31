<?php


namespace Modules\Telegram\Services\Bot;


use TelegramBot\Api\Client;

class ClientBot implements SendMessageInterface, MessageBodyInterface, ClearButtonsInterface
{
    private mixed $bot;

    public function __construct()
    {
        $this->bot = new Client(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendMessage(int $telegramId, string $message, $keyboard = null): void
    {
        $this->bot->sendMessage($telegramId, $message, null, false, null, $keyboard);
    }

    public function getRawMessageBody(): string
    {
        return $this->bot->getRawBody();
    }

    public function clearMessageButtons(?int $messageId, int $chatId): void
    {
        if (empty($messageId)) {
            return;
        }

        $this->bot->editMessageReplyMarkup($chatId, $messageId, null);
    }
}
