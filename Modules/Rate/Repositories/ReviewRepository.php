<?php

namespace Modules\Rate\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Modules\Rate\Models\Review;

class ReviewRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new Review())->newQuery();
    }
    
    public function findById(int $id)
    {
        return $this->getQuery()->findOrFail($id);
    }
}