<?php

namespace App\Components\Serializers;

use Illuminate\Http\JsonResponse;

interface JsonResponseInterface
{
    public function jsonResponse(): JsonResponse;
}