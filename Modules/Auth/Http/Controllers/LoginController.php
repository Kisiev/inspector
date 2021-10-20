<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Formatters\BaseFormatter;
use App\Components\Forms\BaseForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Dto\LoginDto;
use Modules\Auth\Forms\LoginForm;
use Modules\Auth\Services\Login\CheckPasswordInterface;
use Modules\Auth\Services\Login\CheckPasswordService;
use Modules\Auth\Services\Login\CreateTokenInterface;
use Modules\Auth\Services\Login\CreateTokenService;
use Modules\User\Formatters\UserFormatter;
use Modules\User\Models\User;
use Modules\User\Services\FindUserInterface;
use Modules\User\Services\UserService;

class LoginController extends BaseApiController
{
    /** @var UserService */
    private FindUserInterface $userService;
    
    /** @var LoginForm */
    private BaseForm $form;
    
    /** @var UserFormatter */
    private BaseFormatter $userFormatter;
    
    /** @var CheckPasswordService  */
    private CheckPasswordInterface $checkPasswordService;
    
    /** @var CreateTokenService  */
    private CreateTokenInterface $createTokenService;
    
    public function __construct
    (
        FindUserInterface $userService,
        BaseForm $form,
        BaseFormatter $userFormatter,
        CheckPasswordInterface $checkPasswordService,
        CreateTokenInterface $createTokenService
    )
    {
        $this->userService = $userService;
        $this->form = $form;
        $this->userFormatter = $userFormatter;
        $this->checkPasswordService = $checkPasswordService;
        $this->createTokenService = $createTokenService;
    }
    
    public function index(Request $request): JsonResponse
    {
        $this->form->loadFromRequest($request);
        $this->form->validate();

        /** @var LoginDto $dto */
        $dto = $this->form->getDto();

        /** @var User $user */
        $user = $this->userService->findByEmail($dto->getEmail());
        $this->checkPasswordService->check($user, $dto->getPassword());
        $token = $this->createTokenService->create($user, $dto->getUserAgent());

        return $this->successResponse(
            [
                'token' => $token,
                'user'  => $this->userFormatter->serialize($user)
            ]
        );
    }
}