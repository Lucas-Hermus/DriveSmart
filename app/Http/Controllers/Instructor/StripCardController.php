<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Illuminate\Http\Request;

class StripCardController extends Controller
{
    // routes tot the strip card page
    public function index()
    {
        $stripCards = StripCard::where(['active' => 1])->with('student')->get(); //get all stripcards
        return view("instructor.strip_card.index", compact('stripCards')); // return the view
    }

    // routes to the page where you can create a new stripcard
    public function new()
    {
        $students = Student::where('active', 1)->orderBy("first_name", "asc")->get(); // get all students
        return view("instructor.strip_card.new", compact('students')); // return the view with students
    }

    // edits the strip card balance
    public function edit($id)
    {
        $stripCard = StripCard::where('id', $id)->with('student')->first(); // get the correct stripcard
        $students = Student::where('active', 1)->orderBy("first_name", "asc")->get(); // get all students
        return view("instructor.strip_card.edit", compact('students', 'stripCard')); // return the view with students and the stripcard
    }

    // stores the new stripcard
    public function store(Request $request)
    {
        // validates the request to see if it is allowed
        $data = $request->validate([
            'student_id' => 'required',
            'lessons' => 'required|integer|min:1'
        ], [
            // maps certain errors to the correct error response
            'student_id.required' => 'Selecteer een leerling.',
            'lessons.required' => 'vul het aantal lessen in',
            'lessons.integer' => 'het aantal lessen moet als heel getal ingevoerd worden',
            'lessons.min' => 'Het aantal lessen moet een positief getal zijn',
        ]);
        $data['remaining'] = $data['lessons']; // sets remaining lessons equel to the total of the stripcard

        StripCard::insert($data);

        return redirect()->route('instructor.strip_card.index'); // redirect to the stripcard page
    }

    // updates a stripcard
    public function update($id, Request $request)
    {
        $stripCard = StripCard::find($id);

        // validates the request to see if it is allowed
        $data = $request->validate([
            'student_id' => 'required',
            'remaining' => 'required|integer|min:0|max:' . $stripCard->lessons,
        ], [
            // maps certain errors to the correct error response
            'student_id.required' => 'Selecteer een leerling.',
            'remaining.required' => 'vul het aantal tegoed in',
            'remaining.integer' => 'het aantal tegoed moet als heel getal ingevoerd worden',
            'remaining.min' => 'Het aantal tegoed moet 0 of meer zijn',
            'remaining.max' => 'Het maximale tegoed voor deze strippenkaart is ' . $stripCard->lessons,
        ]);

        $stripCard->update($data); // updaste the stripcard

        return redirect()->route('instructor.strip_card.index'); // return the strip card page view
    }

    // soft deletes a stripcard
    public function delete($id, Request $request)
    {
        $stripCard = StripCard::find($id); // find the stripcard
        $stripCard->update(["active" => 0]); // update the active field to 0
        return response()->json($stripCard); // return if the update was successful
    }
}
