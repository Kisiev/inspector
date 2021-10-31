<?php


namespace Modules\Telegram\Services\Bot;


interface ClearButtonsInterface
{
    public function clearMessageButtons(int $messageId, int $chatId): void;
}
