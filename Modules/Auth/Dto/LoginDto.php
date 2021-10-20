<?php

namespace Modules\Auth\Dto;

use App\Components\Dto\BaseDto;

class LoginDto extends BaseDto
{
    private string $email;
    private string $password;
    private string $userAgent;
    
    public function loadFromArray(array $data): void
    {
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->userAgent = $data['user_agent'] ?? null;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }
    
    public function getProperties(): array
    {
        return [
            'email'     => $this->getEmail(),
            'password'  => $this->getPassword(),
            'userAgent' => $this->getUserAgent(),
        ];
    }
}