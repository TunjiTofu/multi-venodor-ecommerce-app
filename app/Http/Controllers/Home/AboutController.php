<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    public function aboutPage()
    {
        $aboutPage = About::find(1);
        return view('admin.about_page.index', compact('aboutPage'));
    }

    public function updateAbout(Request $request)
    {
        $aboutId = $request->id;

        if ($request->file('about_image')) {
            $image = $request->file('about_image');
            $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //resize with laravel image intervention
            Image::make($image)->resize(523, 605)->save('upload/home_about/' . $newImageName);
            $saveUrl = 'upload/home_about/' . $newImageName;

            About::findOrFail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $saveUrl,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'About Page Updated With Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        } else {
            About::findOrFail($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'About Page Updated Without Image',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }
}
