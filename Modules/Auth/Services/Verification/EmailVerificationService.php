<?php

namespace Modules\Auth\Services\Verification;

use App\Components\Helpers\DateHelper;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Modules\Auth\Constants\VerificationStatus;
use Modules\Auth\Exceptions\InvalidVerificationCodeException;
use Modules\Auth\Exceptions\VerificationCodeExpiredException;
use Modules\Auth\Exceptions\VerificationNotFoundException;
use Modules\Auth\Exceptions\VerificationStatusNotValidException;
use Modules\Auth\Factories\EmailVerificationFactory;
use Modules\Auth\Models\Verification;
use Modules\Auth\Repositories\VerificationRepository;

class EmailVerificationService implements EmailVerificationInterface
{
    private const CODE_LENGTH = 30;
    private const CODE_EXPIRED = 5;
    
    /** @var VerificationRepository  */
    private BaseRepository $verificationRepository;

    public function __construct(BaseRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }
    
    private function getHash(): string
    {
        return Str::random(self::CODE_LENGTH);
    }
    
    public function notify(string $email): string
    {
        /** @var Verification $verification */
        $verification = EmailVerificationFactory::create();
        $verification->value = $email;
        $verification->status = VerificationStatus::STATUS_SENT;
        $verification->token = $this->getHash();
        $verification->code = rand(1000, 9999);
        
        $this->verificationRepository->save($verification);
        return $verification->token;
    }
    
    public function verify(string $token, string $code): int
    {
        /** @var Verification $verification */
        $verification = $this->verificationRepository->getByParams($token);
        
        if (empty($verification)) {
            throw new VerificationNotFoundException();
        }

        if ($verification->status !== VerificationStatus::STATUS_SENT) {
            throw new VerificationStatusNotValidException();
        }
        
        if ($verification->code !== $code) {
            throw new InvalidVerificationCodeException();
        }
        
        $expiredTime = DateHelper::modifyDate(DateHelper::now(), '-5 minutes');
        $createdAt = DateHelper::strToTime($verification->created_at);

        if ($createdAt < $expiredTime) {
            $verification->status = VerificationStatus::STATUS_EXPIRED;
            $this->verificationRepository->save($verification);
            throw new VerificationCodeExpiredException();
        }
        
        $verification->status = VerificationStatus::STATUS_CONFIRM;
        $this->verificationRepository->save($verification);

        return $verification->id;
    }
}