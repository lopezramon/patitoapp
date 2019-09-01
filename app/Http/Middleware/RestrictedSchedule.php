<?php

namespace App\Http\Middleware;

use Closure;

class RestrictedSchedule
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
        $time = date("H:i:s");
        if ($time >= "08:00:00" && $time <= "17:00:00") {
            return $next($request);
        }
        return response()->json(['message' => 'Restricted Schedule', 'success' => false],404);
    }
}
