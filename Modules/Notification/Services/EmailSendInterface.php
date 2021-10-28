<?php

namespace Modules\Notification\Services;

interface EmailSendInterface
{
    public function send(string $email, string $message): void;
}