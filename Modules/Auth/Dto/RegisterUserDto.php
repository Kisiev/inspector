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
    
    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'];
        $this->verificationId = $data['verification'];
        $this->password = $data['password'];
    }
    
    public function getName(): string
    {
        return $this->name;
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
    #[ArrayShape(['name' => 'string', 'verificationId' => 'int', 'password' => 'string'])]
    public function getProperties(): array
    {
        return [
            'name' => $this->getName(),
            'verificationId' => $this->getVerificationId(),
            'password' => $this->getPassword()
        ];
    }
}