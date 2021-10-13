<?php

namespace Modules\Auth\Services\Verification;

interface EmailVerificationInterface
{
    public function notify(string $email): string;
    public function verify(string $token, string $code): int;
}