<?php

namespace Modules\Auth\Services\Verification;

use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Exceptions\VerificationNotFoundException;
use Modules\Auth\Exceptions\VerificationStatusNotValidException;
use Modules\Auth\Factories\EmailVerificationFactory;
use Modules\Auth\Models\Verification;
use Modules\Auth\Repositories\VerificationRepository;

class EmailVerificationService implements EmailVerificationInterface
{
    /** @var VerificationRepository  */
    private BaseRepository $verificationRepository;

    public function __construct(BaseRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }
    
    private function getHash(): string
    {
        return Str::random();
    }
    
    public function notify(string $email): void
    {
        /** @var Verification $verification */
        $verification = EmailVerificationFactory::create();
        $verification->value = $email;
        $verification->status = VerificationStatus::STATUS_SENT;
        $verification->code = $this->getHash();
        
        $this->verificationRepository->save($verification);
    }
    
    public function verify(string $code, string $email): void
    {
        /** @var Verification $verification */
        $verification = $this->verificationRepository->getByParams($code);
        
        if (empty($verification)) {
            throw new VerificationNotFoundException();
        }

        if ($verification->status !== VerificationStatus::STATUS_SENT) {
            throw new VerificationStatusNotValidException();
        }
    }
}