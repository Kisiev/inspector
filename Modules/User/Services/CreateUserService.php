<?php

namespace Modules\User\Services;

use App\Components\Dto\BaseDto;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Dto\CreateUserDto;
use Modules\User\Factories\UserFactory;

class CreateUserService implements UserCreateInterface
{
    private BaseRepository $userRepository;

    public function __construct
    (
        BaseRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * @param CreateUserDto $dto
     * @return Model
     */
    public function create(BaseDto $dto): Model
    {
        $user = UserFactory::create();
        $user->fill($dto->getProperties());

        $this->userRepository->save($user);
        return $user;
    }
}