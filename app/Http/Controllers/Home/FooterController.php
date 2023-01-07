<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footerSetup()
    {
        $footer = Footer::find(1);
        return view('admin.footer.index', compact('footer'));
    }

    public function updateFooter(Request $request)
    {
        $footerId = $request->id;
        Footer::findOrFail($footerId)->update([
            'number' => $request->phone,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,
        ]);

        //Toaster Notification
        $notification = array(
            'message' => 'Footer Details Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
        
    }
}
