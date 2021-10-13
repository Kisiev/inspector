<?php

namespace Modules\Auth\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use Modules\Auth\Dto\RegisterUserDto;

class RegisterForm extends BaseForm
{
    protected function rules(): array
    {
        return [
            'name'  => 'required|min:3',
            'email' => 'unique:users|email|required',
        ];
    }
    
    public function getDto(): BaseDto
    {
        $dto = new RegisterUserDto();
        $dto->loadFromArray($this->data);

        return $dto;
    }
}