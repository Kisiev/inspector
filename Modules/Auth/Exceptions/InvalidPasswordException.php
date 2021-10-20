<?php

namespace Modules\Auth\Exceptions;

use App\Exceptions\UnSuccessException;

class InvalidPasswordException extends UnSuccessException
{
    public function __construct($message = 'Неверный пароль', $statusCode = 422, $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}