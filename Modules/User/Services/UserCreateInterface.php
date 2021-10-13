<?php

namespace Modules\User\Services;

use App\Components\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;

interface UserCreateInterface
{
    public function create(BaseDto $dto): Model;
}