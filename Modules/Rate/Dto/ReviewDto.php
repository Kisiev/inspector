<?php

namespace Modules\Rate\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;

class ReviewDto extends BaseDto
{
    private ?int $user_id;
    private ?int $shop_id;
    private ?string $text;
    private ?int $rate;
    
    public function loadFromArray(array $data): void
    {
        $this->user_id = $data['user_id'] ?? null;
        $this->shop_id = $data['shop_id'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->rate = $data['rate'] ?? null;
    }
    
    #[ArrayShape(['user_id' => "int|null", 'shop_id' => "int|null", 'text' => "null|string", 'rate' => "int|null"])]
    public function getProperties(): array
    {
        return [
            'user_id' => $this->user_id,
            'shop_id' => $this->shop_id,
            'text'    => $this->text,
            'rate'    => $this->rate,
        ];
    }
}