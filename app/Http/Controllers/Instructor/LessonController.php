<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    // routes the user to the lesson page
    public function index()
    {
        $instructor = Auth::guard('instructor')->user(); // store the currently authenticated instructor to a variable

        // get all lessons that are active of the currently logged in instructor
        $lessons = Lesson::where(['active' => 1, "instructor_id" => $instructor->id])
            ->orderBy('end', 'asc')->with('car', 'instructor', 'student')
            ->get();
        return view('instructor.lesson.index', compact('lessons')); // returns the page with the lessons
    }

    // routes the user to the week view page
    public function personal()
    {
        $instructor = Auth::guard('instructor')->user();
        // gets all active lessons of the current week that are asigned to the currently logged in instructor.
        $lessons = Lesson::where(['active' => 1, "instructor_id" => $instructor->id])
            ->whereBetween('start', [Carbon::now()->startOfWeek(Carbon::MONDAY), Carbon::now()->endOfWeek(Carbon::SUNDAY)])
            ->with('car', 'instructor', 'student')->orderBy('end', 'asc')
            ->get();

        return view('instructor.lesson.index', compact('lessons')); // returns the page with the lessons
    }

    // routes the user to the edit page for a specific lesson
    public function edit($id)
    {
        $lesson = Lesson::where('id', $id)->with('car', 'instructor', 'student')->first(); // gets the lesson that needs to be viewed
        return view('instructor.lesson.edit', compact('lesson')); // returns the page with the lesson
    }

    // routes the user to the lesson page
    public function update($id, Request $request)
    {
        // cleans up the request to only use the report
        $data = $request->validate([
            'report' => 'nullable'
        ]);

        $lesson = Lesson::find($id); // find the lesson
        $lesson->update($data); // update the lesson

        return redirect()->route('instructor.lesson.personal'); // redirects to the week overview
    }

    // finalise a lesson by setting its status to completed
    public function finish($id, Request $request)
    {
        // cleans up the request to only use the report
        $data = $request->validate([
            'report' => 'nullable'
        ]);
        $data['completed'] = true; // add the completed status

        $lesson = Lesson::with("student.stripCards")->where('id', $id)->first(); // get the lesson
        $lesson->update($data); // update the lesson

        $stripCard = $lesson->student->firstNonEmptyStripCard(); // gets the first strip card with at leas one remaining lesson of the student of the current lesson.
        if ($stripCard == null) { return; } // in case the student doesn't have anny remaining lessons this prevents the update.

        //update the remaining lessons of the strip card.
        $stripCard->update([
            "remaining" => $stripCard->remaining - 1,
        ]);
    }
}
