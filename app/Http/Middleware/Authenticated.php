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
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $instructor = Auth::guard('instructor')->user(); // get the currently logged in instructor
        $student = Auth::guard('student')->user(); // get the currently logged in student

        if (!isset($instructor) && !isset($student)) { // if both of the users are not set than you may not sign in
            return redirect()->route("login"); // return to the login page
        }

        return $next($request); // pass the request to the next function in the route flow
    }
}
