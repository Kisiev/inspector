<?php

namespace Modules\Rate\Resources\Shop;

use App\Resources\PaginatorCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class ShopCollection extends PaginatorCollection
{
    #[ArrayShape(['items' => AnonymousResourceCollection::class])]
    public function withItems(): array
    {
        /** @var LengthAwarePaginator $this */
        return [
            'items' => ShopResource::collection($this->items()),
        ];
    }
}
