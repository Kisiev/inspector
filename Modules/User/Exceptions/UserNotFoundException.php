<?php

namespace Modules\User\Exceptions;

use App\Exceptions\UnSuccessException;

class UserNotFoundException extends UnSuccessException
{
    public function __construct($message = 'Пользователь не найден', $statusCode = 404, $previous = null, $headers = [], $code = 0)
    {
        parent::__construct($message, $statusCode, $previous, $headers, $code);
    }
}