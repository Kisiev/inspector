<?php

namespace Modules\Rate\Resources\City;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Rate\Models\City;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var City $this */
        return [
            'id'   => $this->id,
            'name' => $this->name,
        ];
    }
}
