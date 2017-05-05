<?php

namespace App\Http\Middleware;

use Closure;

class HandleCors
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Allow any origins and methods for development environment
        // because we send requests from http://localhost during development.
        if (getenv('APP_ENV') === 'development') {

            return $response->withHeaders([
                        'Access-Control-Allow-Origin'      => '*',
                        'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Request-With, X-XSRF-TOKEN',
                        'Access-Control-Allow-Credentials' => 'true'
                    ]);
        }

        return $response;
    }
}
