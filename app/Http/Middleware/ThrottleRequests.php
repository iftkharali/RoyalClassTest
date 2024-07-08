<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests as Middleware;

class ThrottleRequests extends Middleware
{
    protected function resolveRequestSignature($request)
    {
        return sha1($request->ip());
    }
}
