<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\UnSuccessException;

class VerificationThrottleException extends UnSuccessException
{
    public function __construct($message, $statusCode = 400, $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}