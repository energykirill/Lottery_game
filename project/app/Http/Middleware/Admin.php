<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()->is_admin) {
            return response()->json([
                'error' => 'Unauthorized admin'
            ], 401);
        }

        return $next($request);
    }
}
