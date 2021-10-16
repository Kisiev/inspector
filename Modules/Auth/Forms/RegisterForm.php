<?php

namespace Modules\Auth\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use Modules\Auth\Dto\RegisterUserDto;

class RegisterForm extends BaseForm
{
    public function getDto(): BaseDto
    {
        $dto = new RegisterUserDto();
        $dto->loadFromArray($this->data);
        
        return $dto;
    }
    
    protected function rules(): array
    {
        return [
            'name'                  => 'required|min:3',
            'verification'          => 'exists:verifications,id|required',
            'email'                 => 'unique:users|required|email',
            'password'              => 'required|confirmed|min:4',
            'password_confirmation' => 'required|min:4',
        ];
    }
}