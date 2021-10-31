<?php

namespace Modules\Telegram\Services\Bot;

interface WebhookInterface
{
    public function setWebhook(string $url): void;
    public function deleteWebhook(): void;
}