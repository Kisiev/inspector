<?php

namespace Modules\Auth\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Constants\VerificationType;
use Modules\Auth\Models\Verification;

class VerificationRepository extends BaseRepository
{
    public function getQuery(): Builder
    {
        return (new Verification())->newQuery();
    }
    
    public function getByParams(string $token, string $type = VerificationType::TYPE_EMAIL): ?Model
    {
        return $this->getQuery()
            ->where('type', $type)
            ->where('token', $token)
            ->first();
    }
    
    public function findById(int $id): ?Model
    {
        return $this->getQuery()->find($id);
    }
}