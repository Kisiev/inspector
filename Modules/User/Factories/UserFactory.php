<?php

namespace Modules\User\Factories;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class UserFactory
{
    public static function create(): Model
    {
        return new User();
    }
}