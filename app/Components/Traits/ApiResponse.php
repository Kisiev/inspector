<?php

namespace App\Components\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse
{
    public function successResponse(array $data, string $message = 'Успешно', int $status = 200): JsonResponse
    {
        return response()->json(
            [
                'message' => $message,
                'data'    => $data,
            ],
            $status
        );
    }

    public function messageResponse(string $message = 'Успешно', int $status = 201): Response
    {
        return response($message, $status);
    }
}