<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $log = "[" . now() . "] "
            . $request->method() . " "
            . $request->fullUrl() . " "
            . json_encode($request->all()) . "\n";

        File::append(storage_path('logs/log.txt'), $log);

        return $next($request);
    }
}
