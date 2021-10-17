<?php

namespace Modules\Auth\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Constants\VerificationStatus;
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
    
    public function getExpiredByIpAndAfterDate(string $ipAddress, string $afterDate): Collection
    {
        return $this->getQuery()
            ->where('sender_ip', $ipAddress)
            ->where('status', VerificationStatus::STATUS_SENT)
            ->where('created_at', '>=', $afterDate)
            ->orderBy('id', 'desc')
            ->get();
    }
}