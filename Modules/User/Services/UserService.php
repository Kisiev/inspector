<?php

namespace Modules\User\Services;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Exceptions\UserNotFoundException;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;

class UserService implements FindUserInterface
{
    /** @var UserRepository  */
    private BaseRepository $userRepository;

    public function __construct(BaseRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function findByEmail(string $email): Model
    {
        /** @var User $user */
        $user = $this->userRepository->findByEmail($email);
        
        if (empty($user)) {
            throw new UserNotFoundException();
        }
        
        return $user;
    }
}