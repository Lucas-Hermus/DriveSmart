<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // gets the user as instructor and as student.
        $instructor = Auth::guard('instructor')->user();
        $student = Auth::guard('student')->user();

        // if the role must be instructor, but you are something else than you may not sign in.
        if ($role == "instructor" && !isset($instructor)) {
            return redirect()->route("login");
        }

        // if the role must be admin, but you are something else than you may not sign in.
        if ($role == "admin"){
            if(!isset($instructor)){ return redirect()->route("login"); }
            if (!$instructor->is_admin) { return redirect()->route("login"); }
        }

        // if the role must be student, but you are something else than you may not sign in.
        if ($role == "student" && !isset($student)) {
            return redirect()->route("login");
        }
        return $next($request); // passes the request to the next function int he route flow
    }
}
