<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeMessage(Request $request)
    {
        //Add Validation
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at'=> Carbon::now(),
        ]);

         //Toaster Notification
         $notification = array(
            'message' => 'Your Message has been Sent Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function contactMessage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.index', compact('contacts'));
    }

    public function deleteMessage($id)
    {
        Contact::findOrFail($id)->delete();

        //Toaster Notification
        $notification = array(
            'message' => 'Message has been Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
