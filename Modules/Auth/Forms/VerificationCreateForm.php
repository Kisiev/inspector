<?php

namespace Modules\Auth\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use App\Components\Forms\LoadFromRequestInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Auth\Constants\VerificationType;
use Modules\Auth\Dto\VerificationCreateDto;

class VerificationCreateForm extends BaseForm implements LoadFromRequestInterface
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
    
    public function loadFromRequest(Request $request): void
    {
        $this->data = $request->all();
        $this->data['sender_ip'] = $request->ip();
    }
}