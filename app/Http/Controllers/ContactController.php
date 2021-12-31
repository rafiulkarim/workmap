<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(){
        $data['title'] = 'Contact';
        return view('contact', $data);
    }

    public function contact_process(Request $request){
        $contact = new Contact;
        $contact->full_name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        $query = $contact->save();
        if ($query){
            return redirect()->back()->with('success', 'Support team will Contact with you very soon');
        }

    }
}
