<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $instructor = Auth::guard('instructor')->user();
        $student = Auth::guard('student')->user();

        if(!isset($instructor) && !isset($student)){
            return redirect()->route("login");
        }

        return $next($request);
    }
}
