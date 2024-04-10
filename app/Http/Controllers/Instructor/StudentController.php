<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Student;

class StudentController extends Controller
{
    // routes to the students page
    public function index()
    {
        $students = Student::where('active', 1)->with('lessons', 'stripCards')->get(); // gets the students
        return view("instructor.student.index", compact('students')); // returns the page
    }

    // routes to the individual student page
    public function show($id)
    {
        $student = Student::where('id', $id)->with('lessons', 'stripCards')->first(); // get the student
        return view("instructor.student.show", compact('student')); // returns the page
    }
}
