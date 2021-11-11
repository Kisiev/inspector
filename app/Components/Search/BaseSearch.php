<?php

namespace App\Components\Search;

use App\Components\Dto\BaseDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface BaseSearch
{
    public function search(BaseDto $dto): LengthAwarePaginator;
}