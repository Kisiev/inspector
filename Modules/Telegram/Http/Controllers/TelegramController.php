<?php

namespace Modules\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function index(Request $request)
    {
        // TODO
        Log::info(json_encode($request->toArray()));
    }
}
