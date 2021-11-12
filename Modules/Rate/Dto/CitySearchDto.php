<?php

namespace Modules\Rate\Dto;

use App\Components\Dto\BaseDto;
use JetBrains\PhpStorm\ArrayShape;

class CitySearchDto extends BaseDto
{
    private ?string $name;

    public function loadFromArray(array $data): void
    {
        $this->name = $data['name'] ?? null;
    }

    #[ArrayShape(['name' => "string"])]
    public function getProperties(): array
    {
        return [
            'name' => $this->name
        ];
    }
}