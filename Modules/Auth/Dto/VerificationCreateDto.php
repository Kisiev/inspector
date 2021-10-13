<?php

namespace Modules\Auth\Dto;

use App\Components\Dto\BaseDto;

class VerificationCreateDto extends BaseDto
{
    private string $email;
    private string $type;
    
    public function loadFromArray(array $data): void
    {
        $this->email = $data['email'];
        $this->type = $data['type'];
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getProperties(): array
    {
        return [
            'email' => $this->getEmail(),
            'type'  => $this->getType(),
        ];
    }
}