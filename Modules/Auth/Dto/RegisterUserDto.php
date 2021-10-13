<?php

namespace Modules\Auth\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class RegisterUserDto extends BaseDto
{
    private string $name;
    private string $email;
    
    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    #[Pure]
    #[ArrayShape(['name' => "string", 'email' => "string"])]
    public function getProperties(): array
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail()
        ];
    }
}