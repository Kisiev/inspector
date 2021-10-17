<?php

namespace App\Components\Forms;

use Illuminate\Http\Request;

interface LoadFromRequestInterface
{
    public function loadFromRequest(Request $request): void;
}