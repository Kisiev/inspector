<?php

namespace Modules\Auth\Services\Register;

use App\Components\Dto\BaseDto;
use App\Components\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Dto\RegisterUserDto;
use Modules\Auth\Exceptions\NotVerifyEmailException;
use Modules\Auth\Services\Verification\ConfirmedInterface;
use Modules\Auth\Services\Verification\VerificationConfirmedService;
use Modules\User\Dto\CreateUserDto;
use Modules\User\Services\CreateUserService;
use Modules\User\Services\UserCreateInterface;

class RegisterService implements RegisterUserInterface
{
    /** @var VerificationConfirmedService  */
    private ConfirmedInterface $verificationConfirmedService;
    
    /** @var CreateUserService  */
    private UserCreateInterface $createUserService;
    
    public function __construct
    (
        ConfirmedInterface $verificationConfirmedService,
        UserCreateInterface $createUserService
    )
    {
        $this->verificationConfirmedService = $verificationConfirmedService;
        $this->createUserService = $createUserService;
    }
    
    /**
     * @param RegisterUserDto $dto
     *
     * @return Model
     */
    public function register(BaseDto $dto): Model
    {
        $email = $this->verificationConfirmedService->getConfirmedValueById($dto->getVerificationId());

        if ($email !== $dto->getEmail()) {
            throw new NotVerifyEmailException();
        }

        $createUserDto = new CreateUserDto();
        $createUserDto->loadFromArray($dto->getProperties());
        $createUserDto->setEmailVerifiedAt(DateHelper::now());
        
        return $this->createUserService->create($createUserDto);
    }
}