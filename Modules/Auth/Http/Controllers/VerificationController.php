<?php

namespace Modules\Auth\Http\Controllers;

use App\Components\Forms\BaseForm;
use Illuminate\Http\Request;
use Modules\Auth\Forms\VerificationCreateForm;
use Modules\Auth\Services\Verification\EmailVerificationInterface;

class VerificationController
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
    
    public function send(Request $request)
    {
        $this->verificationForm->load($request->all())->validate();
        $this->emailVerification->notify($this->verificationForm->getDto()->getEmail());
    }
}