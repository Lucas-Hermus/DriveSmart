<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(){
        $lessons = Lesson::where("active", 1)->with('car', 'instructor', 'student')->get();
        return view('instructor.lesson.index', compact('lessons'));
    }

    public function edit(){

    }
}
