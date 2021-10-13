<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Auth\Constants\VerificationType;

class VerifyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => 'required|int|min:1000',
            'type' => ['required', Rule::in([VerificationType::TYPE_PHONE, VerificationType::TYPE_EMAIL])],
            'token' => 'required|string|min:30'
        ];
    }
}