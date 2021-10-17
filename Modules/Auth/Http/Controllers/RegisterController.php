<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Formatters\BaseFormatter;
use App\Components\Forms\BaseForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Forms\RegisterForm;
use Modules\Auth\Services\Register\RegisterService;
use Modules\Auth\Services\Register\RegisterUserInterface;
use Modules\User\Formatters\UserFormatter;

class RegisterController extends BaseApiController
{
    /** @var RegisterService  */
    private RegisterUserInterface $registerUserService;
    
    /** @var RegisterForm  */
    private BaseForm $registerForm;
    
    /** @var UserFormatter  */
    private BaseFormatter $userFormatter;

    public function __construct
    (
        RegisterUserInterface $registerUserService,
        BaseForm $registerForm,
        BaseFormatter $userFormatter
    )
    {
        $this->registerUserService = $registerUserService;
        $this->registerForm = $registerForm;
        $this->userFormatter = $userFormatter;
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
        
        return $this->successResponse(['user' => $this->userFormatter->serialize($user)]);
    }
}