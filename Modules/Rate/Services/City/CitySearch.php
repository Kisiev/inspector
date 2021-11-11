<?php

namespace Modules\Rate\Services\City;

use App\Components\Dto\BaseDto;
use App\Components\Search\BaseSearch;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Modules\Rate\Dto\CitySearchDto;

class CitySearch implements BaseSearch
{
    private const PER_PAGE = 20;

    private BaseRepository $repository;

    public function __construct
    (
        BaseRepository $repository
    )
    {
        $this->repository = $repository;
    }
    
    /**
     * @param CitySearchDto $dto
     *
     * @return LengthAwarePaginator
     */
    public function search(BaseDto $dto): LengthAwarePaginator
    {
        $props = $dto->getProperties();
        $query = $this->repository->getQuery();
        
        $query->when($props['name'], function(Builder $query) use ($props) {
            $query->where('name', 'like', "%{$props['name']}%");
        });
        
        return $query->paginate(self::PER_PAGE);
    }
}