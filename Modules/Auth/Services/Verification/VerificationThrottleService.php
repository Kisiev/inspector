<?php

namespace Modules\Auth\Services\Verification;

use App\Components\Helpers\DateHelper;
use App\Repositories\BaseRepository;
use Modules\Auth\Exceptions\VerificationThrottleException;
use Modules\Auth\Repositories\VerificationRepository;

class VerificationThrottleService implements ThrottlingInterface
{
    private const THROTTLE_MIN = 2;
    private const THROTTLE_ATTEMPTS = 2;

    /** @var VerificationRepository  */
    private BaseRepository $verificationRepository;

    public function __construct(BaseRepository $verificationRepository)
    {
        $this->verificationRepository = $verificationRepository;
    }

    public function hasAccess(string $ipAddress): void
    {
        $dateTime = DateHelper::modifyDate(DateHelper::now(), '-' . self::THROTTLE_MIN . 'minutes');
        $formattedDateTime = DateHelper::timeToFormat($dateTime);
        $verifications = $this->verificationRepository->getExpiredByIpAndAfterDate($ipAddress, $formattedDateTime);
        
        if ($verifications->count() >= self::THROTTLE_ATTEMPTS) {
            $restOfMinutes = DateHelper::strToTime($verifications[0]->created_at) - $dateTime;
            $restOfMinutes = DateHelper::timeToFormat($restOfMinutes, DateHelper::MINUTES_FORMAT);

            throw new VerificationThrottleException("Код можно будет отправить только через {$restOfMinutes}");
        }
    }
}