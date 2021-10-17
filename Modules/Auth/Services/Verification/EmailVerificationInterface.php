<?php

namespace Modules\Auth\Services\Verification;

use App\Components\Dto\BaseDto;

interface EmailVerificationInterface
{
    public function notify(BaseDto $dto): string;
    public function verify(string $token, string $code): int;
}