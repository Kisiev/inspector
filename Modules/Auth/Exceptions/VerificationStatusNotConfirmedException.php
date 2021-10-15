<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\UnSuccessException;

class VerificationStatusNotConfirmedException extends UnSuccessException
{
    public function __construct($message = 'Неподтвержденный код', $statusCode = 400, $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}