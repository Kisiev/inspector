<?php

namespace Modules\Rate\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;

class ReviewDto extends BaseDto
{
    private ?int $id;
    private ?int $user_id;
    private ?int $shop_id;
    private ?string $text;
    private ?int $rate;
    private ?string $type;
    
    public function loadFromArray(array $data): void
    {
        $this->id = $data['id'] ?? null;
        $this->user_id = $data['user_id'] ?? null;
        $this->shop_id = $data['shop_id'] ?? null;
        $this->text = $data['text'] ?? null;
        $this->rate = $data['rate'] ?? null;
        $this->type = $data['type'] ?? null;
    }
    
    #[ArrayShape(
        [
            'id'      => "int|null",
            'user_id' => "int|null",
            'shop_id' => "int|null",
            'text'    => "null|string",
            'rate'    => "int|null",
            'type'    => "null|string",
        ]
    )]
    public function getProperties(): array
    {
        return [
            'id'      => $this->id,
            'user_id' => $this->user_id,
            'shop_id' => $this->shop_id,
            'text'    => $this->text,
            'rate'    => $this->rate,
            'type'    => $this->type,
        ];
    }
}