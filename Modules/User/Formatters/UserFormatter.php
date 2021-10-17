<?php

namespace Modules\User\Formatters;

use App\Components\Formatters\BaseFormatter;

class UserFormatter extends BaseFormatter
{
    public function attributes(): array
    {
        return [
            'id',
            'name',
            'email'
        ];
    }
}