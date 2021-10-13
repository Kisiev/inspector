<?php

namespace Modules\Auth\Services\Register;

use App\Components\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;

interface RegisterUserInterface
{
    public function createUser(BaseDto $dto): Model;
}