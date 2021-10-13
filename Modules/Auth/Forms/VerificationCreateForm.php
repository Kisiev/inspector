<?php

namespace Modules\Auth\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use Illuminate\Validation\Rule;
use Modules\Auth\Constants\VerificationType;
use Modules\Auth\Dto\VerificationCreateDto;

class VerificationCreateForm extends BaseForm
{
    protected function rules(): array
    {
        return [
            'email' => 'email|unique:users|required',
            'type' => 'required|' . Rule::in([VerificationType::TYPE_EMAIL, VerificationType::TYPE_PHONE])
        ];
    }
    
    public function getDto(): BaseDto
    {
        $dto = new VerificationCreateDto();
        $dto->loadFromArray($this->data);

        return $dto;
    }
}