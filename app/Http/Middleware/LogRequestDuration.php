<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestDuration
{
    protected $startTime;

    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $endTime = microtime(true);
        $duration = $endTime - $this->startTime;
        $logMessage = "Request to {$request->getMethod()} {$request->getPathInfo()} completed in {$duration} seconds.";
        Log::info($logMessage);
    }
}
