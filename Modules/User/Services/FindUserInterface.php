<?php

namespace Modules\User\Services;

use Illuminate\Database\Eloquent\Model;

interface FindUserInterface
{
    public function findByEmail(string $email): Model;
}