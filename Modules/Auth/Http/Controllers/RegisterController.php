<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Forms\BaseForm;
use Illuminate\Http\Request;
use Modules\Auth\Services\Register\RegisterUserInterface;

class RegisterController extends BaseApiController
{
    private RegisterUserInterface $registerUserService;
    private BaseForm $registerForm;

    public function __construct
    (
        RegisterUserInterface $registerUserService,
        BaseForm $registerForm
    )
    {
        $this->registerUserService = $registerUserService;
        $this->registerForm = $registerForm;
    }
    
    public function index(Request $request)
    {
        $this->registerForm->load($request->all())->validate();
        $this->registerForm->getDto()->getProperties();
    }
}