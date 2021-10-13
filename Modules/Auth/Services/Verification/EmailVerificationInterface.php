<?php

namespace Modules\Auth\Services\Verification;

interface EmailVerificationInterface
{
    public function notify(string $email): void;
    public function verify(string $code, string $email): void;
}