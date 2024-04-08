<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripCardController extends Controller
{
    public function index(){
        return view("instructor.strip_card.index");
    }

    public function new(){
        return view("instructor.strip_card.new");
    }

    public function edit(){
        return view("instructor.strip_card.edit");
    }

    public function store(){

    }

    public function update(){

    }
}
