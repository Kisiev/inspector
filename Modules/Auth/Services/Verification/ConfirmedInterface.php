<?php

namespace Modules\Auth\Services\Verification;

interface ConfirmedInterface
{
    public function getConfirmedValueById(int $id): string;
}