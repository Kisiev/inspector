<?php

namespace App\Exceptions;

use App\Components\Serializers\ExceptionSerializer;
use App\Components\Serializers\ValidationExceptionSerializer;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];
    
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    public function render($request, Throwable $e)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $exception = $this->prepareException($e);
            if ($exception instanceof ValidationException) {
                return (new ValidationExceptionSerializer($exception->validator, $exception->getMessage(), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, $exception->errors()))->jsonResponse();
            } else if ($exception instanceof NotFoundHttpException) {
                $message = empty($exception->getMessage()) ? 'Страница не найдена' : $exception->getMessage();
                 return (new ExceptionSerializer($message, ResponseAlias::HTTP_NOT_FOUND))->jsonResponse();
            } else if ($exception instanceof UnSuccessException) {
                return (new ExceptionSerializer($exception->getMessage(), $exception->getStatusCode()))->jsonResponse();
            }

            $errors = [];
            $status = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;

            if (method_exists($exception,'getStatusCode')) {
                $status = $exception->getStatusCode();
            }

            if (config('app.debug')) {
                $errors['line'] = $exception->getLine();
                $errors['trace'] = $exception->getTrace();
                $errors['code'] = $exception->getCode();
            }

            return (new ExceptionSerializer($exception->getMessage(), $status, $errors))->jsonResponse();
        }
    }
}
