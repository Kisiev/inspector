<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Auth\Services\Verification\ThrottlingInterface;

class VerificationThrottle
{
    private ThrottlingInterface $verificationThrottleService;
    
    public function __construct(ThrottlingInterface $verificationThrottleService)
    {
        $this->verificationThrottleService = $verificationThrottleService;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $this->verificationThrottleService->hasAccess($request->ip());

        return $next($request);
    }
}
