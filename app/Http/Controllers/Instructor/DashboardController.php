<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("instructor.dashboard.index");
    }

    public function contact(){
        return view("instructor.dashboard.contact");
    }

    public function storeContact(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required',
        ],[
            "name.required" => "vul een naam in.",
            "email.required" => "vul een email in.",
            "email.email" => "vul een geldige email in",
            "text.required" => "Vul een vraag of opmerking in"
        ]);

        Contact::insert($data);

        return redirect()->back()->with('message', 'Uw vraag/opmerking is successvol verstuurt naar DriveSmart.');
    }
}
