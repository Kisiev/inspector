<?php

namespace Modules\Auth\Services\Verification;

interface ThrottlingInterface
{
    public function hasAccess(string $ipAddress): void;
}