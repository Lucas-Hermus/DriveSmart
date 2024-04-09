<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $instructor = Auth::guard('instructor')->user();
        $student = Auth::guard('student')->user();
        if($role == "instructor" && !isset($instructor)){
            return redirect()->route("login");
        }
        if($role == "admin" && !isset($instructor)){
            if(!$instructor->is_admin){
                return redirect()->route("login");
            }
        }
        if($role == "student" && !isset($student)){
            return redirect()->route("login");
        }
        return $next($request);
    }
}
