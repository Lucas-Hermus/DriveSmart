<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // brings the user to the login page
    public function login()
    {
        if (Auth::guard('instructor')->check()) { // checks if an instructor is already logged in
            return redirect()->route("instructor.lesson.personal"); // routes to the week overview page if that's the case
        }

        if (Auth::guard('student')->check()) { // attempts to authenticate as a student
            return redirect()->route("instructor.dashboard.index"); // a student may not enter the application for now but this will change during the merge
        }

        return view("login"); // shows the login page
    }

    // attempts a login given an email and a password
    public function attemptLogin(Request $request)
    {
        $data = $request->validate([
            'password' => 'required',
            'email' => 'required|email',
        ], [
            // maps certain errors to the correct error response
            "password.required" => "Ongeldige login gegevens",
            "email.required" => "Ongeldige login gegevens",
            "email.email" => "Ongeldige login gegevens",
        ]);

        if (Auth::guard('student')->attempt($data)) { // attempts to authenticate as a student
            return redirect()->route("login"); // a student may not enter the application for now but this will change during the merge
        }

        if (Auth::guard('instructor')->attempt($data)) { // attempts to authenticate as an instructor
            return redirect()->route("instructor.lesson.personal"); // redirects to the week overview of the instructor
        }

        return redirect()->back()->withInput()->withErrors(['login_error' => 'Ongeldige login gegevens']); // return back to login screen with a message
    }

    // signs the user out
    public function signOut()
    {
        Auth::guard('instructor')->logout(); // attempt to sign out as an instructor
        Auth::guard('student')->logout(); // attempt to sign out as an instructor
    }
}
