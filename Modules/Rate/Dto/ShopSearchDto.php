<?php

namespace Modules\Rate\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;

class ShopSearchDto extends BaseDto
{
    private ?string $name;
    private ?int $cityId;
    private ?string $rateFrom;
    private ?string $rateTo;
    
    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'] ?? null;
        $this->cityId = $data['city_id'] ?? null;
        $this->rateFrom = $data['rate_from'] ?? null;
        $this->rateTo = $data['rate_to'] ?? null;
    }
    
    public function getProperties(): array
    {
        return [
            'name'      => $this->name,
            'city_id'   => $this->cityId,
            'rate_from' => $this->rateFrom,
            'rate_to'   => $this->rateTo,
        ];
    }
}