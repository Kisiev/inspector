<?php

namespace Modules\User\Dto;

use App\Components\Dto\BaseDto;

class CreateUserDto extends BaseDto
{
    private string $name;
    private string $email;
    private string $email_verified_at;
    private string $password;

    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->email_verified_at = $data['email_verified_at'] ?? null;
        $this->password = $data['password'];
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function getProperties(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'email_verified_at' => $this->getEmailVerifiedAt(),
            'password' => $this->getPassword()
        ];
    }
}