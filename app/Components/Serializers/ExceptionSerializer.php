<?php

namespace App\Components\Serializers;

use Illuminate\Http\JsonResponse;

class ExceptionSerializer implements JsonResponseInterface
{
    protected string $message;
    protected int $status;
    protected array $errors = [];
    
    public function __construct(string $message, int $status = 400, array $errors = [])
    {
        $this->message = $message;
        $this->status = $status;
        $this->errors = $errors;
    }
    
    public function getMessage(): string
    {
        return $this->message;
    }
    
    public function getStatus(): int
    {
        return $this->status;
    }
    
    public function getErrors(): array
    {
        return $this->errors;
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
        return response()->json($this->toArray(), $this->status);
    }
}