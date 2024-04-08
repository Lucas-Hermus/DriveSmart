<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = Student::where('active', 1)->with('lessons', 'stripCards')->get();

        return view("instructor.student.index", compact('students'));
    }
}
