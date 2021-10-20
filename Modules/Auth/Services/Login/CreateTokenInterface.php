<?php

namespace Modules\Auth\Services\Login;

use Illuminate\Database\Eloquent\Model;

interface CreateTokenInterface
{
    public function create(Model $user, string $tokenName): string;
}