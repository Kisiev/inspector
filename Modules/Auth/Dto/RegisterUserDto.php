<?php

namespace Modules\Auth\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class RegisterUserDto extends BaseDto
{
    private string $name;
    private int $verificationId;
    private string $password;
    private string $email;
    
    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->verificationId = $data['verification'];
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
    
    public function getVerificationId(): int
    {
        return $this->verificationId;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
    
    #[Pure]
    #[ArrayShape(['name' => "string", 'verificationId' => "int", 'password' => "string", 'email' => "string"])]
    public function getProperties(): array
    {
        return [
            'name' => $this->getName(),
            'verificationId' => $this->getVerificationId(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail()
        ];
    }
}