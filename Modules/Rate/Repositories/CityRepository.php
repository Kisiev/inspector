<?php

namespace Modules\Rate\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Modules\Rate\Models\City;

class CityRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new City())->newQuery();
    }
}