<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Image;

class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        $homeSlide = HomeSlide::find(1);
        // dd($homeSlide->title);
        return view('admin.home_slide.slide_all', compact('homeSlide'));
    }

    public function updateSlider(Request $request)
    {
        $slideId = $request->id;

        if ($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //resize with laravel image intervention
            Image::make($image)->resize(600, 820)->save('upload/home_slide/' . $newImageName);
            $saveUrl = 'upload/home_slide/' . $newImageName;

            HomeSlide::findOrFail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $saveUrl,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'Home Slider Updated With Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        } else {
            HomeSlide::findOrFail($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'Home Slider Updated Successfully',
                'alert-type' => 'success',
            );

            return redirect()->back()->with($notification);
        }
    }
}
