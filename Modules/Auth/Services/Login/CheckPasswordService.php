<?php

namespace Modules\Auth\Services\Login;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Exceptions\InvalidPasswordException;
use Modules\User\Models\User;

class CheckPasswordService implements CheckPasswordInterface
{
    /**
     * @param User $user
     * @param string $password
     */
    public function check(Model $user, string $password): void
    {
        if (!Hash::check($password, $user->password)) {
            throw new InvalidPasswordException();
        }
    }
}