<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Instructor\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // routes a user to the dashboard page
    public function index()
    {
        return view("instructor.dashboard.index");
    }

    // routes a user to the contact page
    public function contact()
    {
        return view("instructor.dashboard.contact");
    }

    // stores a new contact form in the database
    public function storeContact(Request $request)
    {
        // validates the request to see if it is allowed
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'text' => 'required',
        ], [
            // maps certain errors to the correct error response
            "name.required" => "vul een naam in.",
            "email.required" => "vul een email in.",
            "email.email" => "vul een geldige email in",
            "text.required" => "Vul een vraag of opmerking in"
        ]);

        Contact::insert($data); // inserts the data into the contract table

        return redirect()->back()->with('message', 'Uw vraag/opmerking is successvol verstuurt naar DriveSmart.'); // return back with a success message
    }
}
