<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Illuminate\Http\Request;

class StripCardController extends Controller
{
    public function index()
    {
        $stripCards = StripCard::where(['active' => 1])->with('student')->get();
        return view("instructor.strip_card.index", compact('stripCards'));
    }

    public function new()
    {
        $students = Student::where('active', 1)->orderBy("first_name", "asc")->get();
        return view("instructor.strip_card.new", compact('students'));
    }

    public function edit($id)
    {
        $stripCard = StripCard::where('id', $id)->with('student')->first();
        $students = Student::where('active', 1)->orderBy("first_name", "asc")->get();
        return view("instructor.strip_card.edit", compact('students', 'stripCard'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required',
            'lessons' => 'required|integer|min:1'
        ], [
            'student_id.required' => 'Selecteer een leerling.',
            'lessons.required' => 'vul het aantal lessen in',
            'lessons.integer' => 'het aantal lessen moet als heel getal ingevoerd worden',
            'lessons.min' => 'Het aantal lessen moet een positief getal zijn',
        ]);
        $data['remaining'] = $data['lessons'];

        StripCard::insert($data);

        return redirect()->route('instructor.strip_card.index');
    }

    public function update($id, Request $request)
    {
        $stripCard = StripCard::find($id);

        $data = $request->validate([
            'student_id' => 'required',
            'remaining' => 'required|integer|min:1|max:' . $stripCard->lessons,
        ], [
            'student_id.required' => 'Selecteer een leerling.',
            'remaining.required' => 'vul het aantal tegoed in',
            'remaining.integer' => 'het aantal tegoed moet als heel getal ingevoerd worden',
            'remaining.min' => 'Het aantal tegoed moet een positief getal zijn',
            'remaining.max' => 'Het maximale tegoed voor deze strippenkaart is ' . $stripCard->lessons,
        ]);

        $stripCard->update($data);

        return redirect()->route('instructor.strip_card.index');
    }

    public function delete($id, Request $request)
    {
        $stripCard = StripCard::find($id);
        $stripCard->update(["active" => 0]);
        return response()->json($stripCard);
    }
}
