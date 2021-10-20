<?php

namespace Modules\Auth\Services\Login;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class CreateTokenService implements CreateTokenInterface
{
    /**
     * @param User  $user
     * @param string $tokenName
     *
     * @return string
     */
    public function create(Model $user, string $tokenName = 'default'): string
    {
        return $user->createToken($tokenName)->plainTextToken;
    }
}