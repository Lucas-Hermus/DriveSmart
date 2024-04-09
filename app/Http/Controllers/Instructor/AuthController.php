<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view("instructor.dashboard.index");
    }
    public function login(){

        if (auth()->check()) {
            return view("instructor.student.index");
        }
        return view("login");
    }

    public function attemptLogin(Request $request){
        $credentials['email'] = $request->email;
        $credentials['password'] = $request->password;
        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->route("instructor.student.index");
        }

        if (Auth::guard('instructor')->attempt($credentials)) {
            return redirect()->route("instructor.student.index");
        }
        return redirect()->back()->withInput()->withErrors(['email' => 'Ongeldige login gegevens']);
    }

    public function signOut()
    {
        Auth::guard('instructor')->logout();
        Auth::guard('student')->logout();
    }
}
