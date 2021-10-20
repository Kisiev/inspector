<?php

namespace Modules\Auth\Forms;

use App\Components\Dto\BaseDto;
use App\Components\Forms\BaseForm;
use App\Components\Forms\LoadFromRequestInterface;
use Illuminate\Http\Request;
use Modules\Auth\Dto\LoginDto;

class LoginForm extends BaseForm implements LoadFromRequestInterface
{
    public function getDto(): BaseDto
    {
        $dto = new LoginDto();
        $dto->loadFromArray($this->data);
        
        return $dto;
    }
    
    protected function rules(): array
    {
        return [
            'email'    => 'required|exists:users|email',
            'password' => 'required|min:4',
        ];
    }
    
    public function loadFromRequest(Request $request): void
    {
        $this->data = $request->all();
        $this->data['user_agent'] = $request->userAgent();
    }
}