<?php

namespace Modules\Rate\Resources;

use App\Resources\PaginatorCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class CityCollection extends PaginatorCollection
{
    #[ArrayShape(['items' => AnonymousResourceCollection::class])]
    public function withItems(): array
    {
        /** @var LengthAwarePaginator $this */
        return [
            'items' => CityResource::collection($this->items()),
        ];
    }
}
