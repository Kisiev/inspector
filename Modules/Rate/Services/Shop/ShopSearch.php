<?php

namespace Modules\Rate\Services\Shop;

use App\Components\Dto\BaseDto;
use App\Components\Search\BaseSearch;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Modules\Rate\Dto\ShopSearchDto;

class ShopSearch implements BaseSearch
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
     * @param ShopSearchDto $dto
     *
     * @return LengthAwarePaginator
     */
    public function search(BaseDto $dto): LengthAwarePaginator
    {
        $props = $dto->getProperties();
        $query = $this->repository->getQuery();
        
        $this->applyNameFilter($query, $props);
        $this->applyCityFilter($query, $props);
        $this->applyRateFromFilter($query, $props);
        $this->applyRateToFilter($query, $props);
        
        return $query->paginate(self::PER_PAGE);
    }
    
    private function applyNameFilter(Builder $query, array $props): void
    {
        $query->when($props['name'], function(Builder $query) use ($props) {
            $query->where('name', 'like', "%{$props['name']}%");
        });
    }
    
    private function applyCityFilter(Builder $query, array $props): void
    {
        $query->when($props['city_id'], function(Builder $query) use ($props) {
            $query->where('city_id', $props['city_id']);
        });
    }
    
    private function applyRateFromFilter(Builder $query, array $props): void
    {
        $query->when($props['rate_from'], function(Builder $query) use ($props) {
            $query->where('rate', '>=', $props['rate_from']);
        });
    }
    
    private function applyRateToFilter(Builder $query, array $props): void
    {
        $query->when($props['rate_to'], function(Builder $query) use ($props) {
            $query->where('rate', '<=', $props['rate_to']);
        });
    }
}