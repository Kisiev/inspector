<?php

namespace Modules\Auth\Services\Login;

use Illuminate\Database\Eloquent\Model;

interface CheckPasswordInterface
{
    public function check(Model $user, string $password): void;
}