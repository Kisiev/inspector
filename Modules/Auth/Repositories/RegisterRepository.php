<?php

namespace Modules\Auth\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class RegisterRepository
{
    public function create(array $userData): Model
    {
        return (new User)->newQuery()->create($userData);
    }
}