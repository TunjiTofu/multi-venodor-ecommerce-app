<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function homeAbout()
    {
        $aboutPage = About::find(1);
        return view('frontend.about', compact('aboutPage'));
    }

    public function aboutMultiImage()
    {
        return view('admin.about_page.multi_image');
    }

    public function storeMultiImage(Request $request)
    {
        $image = $request->file('multi_image');
        foreach ($image as $multi_image) {

            $newImageName = hexdec(uniqid()) . '.' . $multi_image->getClientOriginalExtension();

            //resize with laravel image intervention
            Image::make($multi_image)->resize(220, 220)->save('upload/home_about/' . $newImageName);
            $saveUrl = 'upload/home_about/' . $newImageName;

            MultiImage::insert([
                'multi_image' => $saveUrl,
                'created_at' => Carbon::now(),
            ]);
        } //end foreach loop

        //Toaster Notification
        $notification = array(
            'message' => 'Multi Image Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
