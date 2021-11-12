<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Forms\BaseForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Forms\RegisterForm;
use Modules\Auth\Services\Register\RegisterService;
use Modules\Auth\Services\Register\RegisterUserInterface;
use Modules\User\Resources\UserCollection;

class RegisterController extends BaseApiController
{
    /** @var RegisterService  */
    private RegisterUserInterface $registerUserService;
    
    /** @var RegisterForm  */
    private BaseForm $registerForm;

    public function __construct
    (
        RegisterUserInterface $registerUserService,
        BaseForm $registerForm,
    )
    {
        $this->registerUserService = $registerUserService;
        $this->registerForm = $registerForm;
    }
    
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $this->registerForm->load($request->all())->validate();
        $user = $this->registerUserService->register($this->registerForm->getDto());
        
        return $this->successResponse(['user' => UserCollection::make($user)]);
    }
}