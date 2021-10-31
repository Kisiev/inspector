<?php


namespace Modules\Telegram\Services\Bot;


interface SendMessageInterface
{
    public function sendMessage(int $telegramId, string $message, $keyboard = null);
}
