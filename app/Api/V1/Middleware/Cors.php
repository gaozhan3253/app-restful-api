<?php

namespace App\Api\V1\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json');
        header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        header('Access-Control-Allow-Credentials', 'false');
        return $next($request);
    }

}
