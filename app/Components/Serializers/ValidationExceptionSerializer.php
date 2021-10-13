<?php

namespace App\Components\Serializers;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;

class ValidationExceptionSerializer implements JsonResponseInterface
{
    /** @var Validator */
    private $validator;
    private string $message;
    private int $status;
    private array $errors;
    
    public function __construct($validator, string $message = 'Некорректные данные', int $status = 422, array $errors = [])
    {
        $this->validator = $validator;
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }
    
    public function getMessage(): string
    {
        return empty($this->message) ? $this->validator->errors()->first() : $this->message;
    }
    
    public function getStatus(): int
    {
        return $this->status;
    }
    
    public function getErrors(): array
    {
        return empty($this->errors) ? $this->validator->errors()->toArray() : $this->errors;
    }
    
    public function toArray(): array
    {
        return [
            'message' => $this->getMessage(),
            'status'  => $this->getStatus(),
            'errors'  => $this->getErrors(),
        ];
    }
    
    public function jsonResponse(): JsonResponse
    {
        return response()->json($this->toArray(), $this->getStatus());
    }
}