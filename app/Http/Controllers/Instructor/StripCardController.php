<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\StripCard;
use App\Models\Instructor\Student;
use Illuminate\Http\Request;

class StripCardController extends Controller
{
    public function index(){
        $stripCards = StripCard::where(['active' => 1])->with('student')->first();
        return view("instructor.strip_card.index", $stripCards);
    }

    public function new(){
        $students = Student::where('active', 1)->get();
        return view("instructor.strip_card.new", compact('students'));
    }

    public function edit(){
        return view("instructor.strip_card.edit");
    }

    public function store(Request $request){
        $data = $request->validate([
            'student_id' => 'required',
            'lessons' => 'required|integer'
        ],[
            'student_id.required' => 'Selecteer een leerling.',
            'lessons.required' => 'vul het aantal lessen in',
            'lessons.integer' => 'het aantal lessen moet als heel getal ingevoerd worden',
        ]);
        $data['remaining'] = $data['lessons'];

        StripCard::insert($data);

        return redirect()->route('instructor.strip_card.index');
    }

    public function update(){

    }
}
