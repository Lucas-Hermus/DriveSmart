<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // brings a user to the dashboard page
    public function index()
    {
        return view("instructor.dashboard.index");
    }

    // brings a user to the login page
    public function login()
    {
        if (Auth::guard('instructor')->check()) { // check if an instructor is already logged in
            return redirect()->route("instructor.lesson.personal"); // route to the week overview page if that's the case
        }

        return view("login"); // show the login page
    }

    // attempt a login given a email and a password
    public function attemptLogin(Request $request)
    {
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;

        if (Auth::guard('student')->attempt($credentials)) { // attempt to authenticate as a student
            return redirect()->route("login");
        }

        if (Auth::guard('instructor')->attempt($credentials)) { // attempt to authenticate as an instructor
            return redirect()->route("instructor.lesson.personal");
        }

        return redirect()->back()->withInput()->withErrors(['email' => 'Ongeldige login gegevens']); // return back to login screen with a message
    }

    // signs the user out
    public function signOut()
    {
        Auth::guard('instructor')->logout(); // attempt to sign out as an instructor
        Auth::guard('student')->logout(); // attempt to sign out as an instructor
    }
}
