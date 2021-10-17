<?php

namespace Modules\Auth\Dto;

use App\Components\Dto\BaseDto;

class VerificationCreateDto extends BaseDto
{
    private string $email;
    private string $type;
    private string $senderIp;
    
    public function loadFromArray(array $data): void
    {
        $this->email = $data['email'];
        $this->type = $data['type'];
        $this->senderIp = $data['sender_ip'] ?? null;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getSenderIp(): ?string
    {
        return $this->senderIp;
    }
    
    public function getProperties(): array
    {
        return [
            'email'     => $this->getEmail(),
            'type'      => $this->getType(),
            'sender_ip' => $this->getSenderIp(),
        ];
    }
}