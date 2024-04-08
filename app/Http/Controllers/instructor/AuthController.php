<?php

namespace App\Http\Controllers\instructor;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index(){
        return view("instructor.example.index");
    }
    public function signOut(){
        return view("instructor.example.index");
    }
    public function attemptLogin(){
        return view("instructor.example.index");
    }
    public function test(){
        return view("instructor.example.new");
    }
}
