<?php

namespace Modules\Rate\Resources\Shop;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Rate\Models\Shop;
use Modules\Rate\Resources\City\CityResource;

class ShopResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Shop $this */
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'lat'         => $this->lat,
            'long'        => $this->long,
            'rate'        => $this->rate,
            'city_id'     => $this->city_id,
            'city'        => CityResource::make($this->city),
        ];
    }
}
