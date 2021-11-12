<?php

namespace App\Resources;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class PaginatorCollection extends ResourceCollection
{
    public abstract function withItems(): array;
    
    final public function toArray($request): array
    {
        /** @var LengthAwarePaginator $this */
        $collection = [
            'current_page' => $this->currentPage(),
            'last_page'    => $this->lastPage(),
            'per_page'     => $this->perPage(),
            'total'        => $this->total(),
        ];
        
        return array_merge($this->withItems(), $collection);
    }
}
