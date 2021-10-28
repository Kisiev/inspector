<?php

namespace Modules\Notification\Services;

use Illuminate\Support\Facades\Log;

class EmailSendService implements EmailSendInterface
{
    public function send(string $email, string $message): void
    {
        // TODO: Implement send() method.
        Log::info($email . $message);
    }
}