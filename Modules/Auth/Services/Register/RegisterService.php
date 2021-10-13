<?php

namespace Modules\Auth\Services\Register;

use App\Components\Dto\BaseDto;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Dto\RegisterUserDto;

class RegisterService implements RegisterUserInterface
{
    
    /**
     * @param RegisterUserDto $dto
     *
     * @return Model
     */
    public function createUser(BaseDto $dto): Model
    {

    }
}