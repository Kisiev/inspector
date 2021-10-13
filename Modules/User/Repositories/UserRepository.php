<?php

namespace Modules\User\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Models\User;

class UserRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new User())->newQuery();
    }
}