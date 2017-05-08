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

        return $response->withHeaders([
                    'Access-Control-Allow-Origin'      => '*',
                    'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Request-With, X-XSRF-TOKEN',
                    'Access-Control-Allow-Credentials' => 'true'
                ]);
    }
}
