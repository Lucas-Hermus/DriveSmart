<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function index()
    {
        $instructor = Auth::guard('instructor')->user();
        $lessons = Lesson::where(['active' => 1, "instructor_id" => $instructor->id])->orderBy('end', 'asc')->with(
            'car',
            'instructor',
            'student'
        )->get();
        return view('instructor.lesson.index', compact('lessons'));
    }

    public function personal()
    {
        $instructor = Auth::guard('instructor')->user();
        $lessons = Lesson::where(['active' => 1, "instructor_id" => $instructor->id])->whereBetween(
            'start',
            [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)]
        )->with('car', 'instructor', 'student')->orderBy('end', 'asc')->get();
        return view('instructor.lesson.index', compact('lessons'));
    }

    public function edit($id)
    {
        $lesson = Lesson::where('id', $id)->with('car', 'instructor', 'student')->first();
        return view('instructor.lesson.edit', compact('lesson'));
    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'report' => 'nullable'
        ]);

        $lesson = Lesson::find($id);
        $lesson->update($data);

        return redirect()->route('instructor.lesson.personal');
    }

    public function finish($id, Request $request)
    {
        $data = $request->validate([
            'report' => 'nullable'
        ]);
        $data['completed'] = true;

        $lesson = Lesson::with("student.stripCards")->where('id', $id)->first();
        $lesson->update($data);

        $stripCard = $lesson->student->firstNonEmptyStripCard();
        if ($stripCard == null) {
            return;
        }
        $stripCard->update([
            "remaining" => $stripCard->remaining - 1,
        ]);
    }
}
