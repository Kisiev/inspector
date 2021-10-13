<?php

namespace Modules\Auth\Factories;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Constants\VerificationType;
use Modules\Auth\Models\Verification;

class EmailVerificationFactory
{
    public static function create(): Model
    {
        $verification = new Verification();
        $verification->type = VerificationType::TYPE_EMAIL;
        
        return $verification;
    }
}