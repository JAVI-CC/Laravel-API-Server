<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
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
        if(response()->json(config('app.api_key')) != response()->json("58cd1658e9a605d139043ef426e16b9d")) {
            return response()->json(['message' => 'Api key or App key not found'], 401);
        }
        return $next($request);
    }
}
