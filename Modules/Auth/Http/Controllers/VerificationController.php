<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Controllers\BaseApiController;
use App\Components\Forms\BaseForm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Auth\Forms\VerificationCreateForm;
use Modules\Auth\Http\Requests\VerifyRequest;
use Modules\Auth\Services\Verification\EmailVerificationInterface;

class VerificationController extends BaseApiController
{
    private EmailVerificationInterface $emailVerification;
    
    /** @var VerificationCreateForm  */
    private BaseForm $verificationForm;
    
    public function __construct
    (
        EmailVerificationInterface $emailVerification,
        BaseForm $verificationForm
    )
    {
        $this->emailVerification = $emailVerification;
        $this->verificationForm = $verificationForm;
    }
    
    public function send(Request $request): JsonResponse
    {
        $this->verificationForm->loadFromRequest($request);
        $this->verificationForm->validate();
        $verificationCode = $this->emailVerification->notify($this->verificationForm->getDto());
        
        return $this->successResponse(['token' => $verificationCode]);
    }
    
    public function verify(VerifyRequest $request): JsonResponse
    {
        $verificationId = $this->emailVerification->verify($request->get('token'), $request->get('code'));
        return $this->successResponse(['verification' => $verificationId]);
    }
}