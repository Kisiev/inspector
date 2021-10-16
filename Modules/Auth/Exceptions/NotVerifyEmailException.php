<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\UnSuccessException;

class NotVerifyEmailException extends UnSuccessException
{
    public function __construct($message = 'Не подтвержденный E-mail', $statusCode = 400, $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}