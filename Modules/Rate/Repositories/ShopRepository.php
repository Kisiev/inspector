<?php

namespace Modules\Rate\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Modules\Rate\Models\Shop;

class ShopRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new Shop())->newQuery();
    }
}