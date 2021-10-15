<?php

namespace Modules\Auth\Services\Verification;

use App\Repositories\BaseRepository;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Exceptions\VerificationNotFoundException;
use Modules\Auth\Exceptions\VerificationStatusNotValidException;
use Modules\Auth\Models\Verification;
use Modules\Auth\Repositories\VerificationRepository;

class VerificationConfirmedService implements ConfirmedInterface
{
    /** @var VerificationRepository  */
    private BaseRepository $verificationRepository;
    
    public function __construct(BaseRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }
    
    public function getConfirmedValueById(int $id): string
    {
        /** @var Verification $verification */
        $verification = $this->verificationRepository->findById($id);
        
        if (empty($verification)) {
            throw new VerificationNotFoundException();
        }
        
        if ($verification->status !== VerificationStatus::STATUS_CONFIRM) {
            throw new VerificationStatusNotValidException();
        }
        
        return $verification->value;
    }
}