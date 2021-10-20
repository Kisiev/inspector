<?php

namespace Modules\User\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Models\User;

class UserRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new User())->newQuery();
    }
    
    public function findByEmail(string $email): ?Model
    {
        return $this->getQuery()->where('email', $email)->first();
    }
}