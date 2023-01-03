<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class PortfolioController extends Controller
{
    public function allPortfolio()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolio.all_portfolio', compact('portfolios'));
    }

    public function addPortfolio()
    {
        return view('admin.portfolio.add_portfolio');
    }

    public function insertPortfolio(Request $request)
    {
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
            'portfolio_description' => 'required',
        ], [
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image Must be Selected is Required',
            'portfolio_description.required' => 'Portfolio Description is Required',
        ]);

        $image = $request->file('portfolio_image');
        $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //resize with laravel image intervention
        Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $newImageName);
        $saveUrl = 'upload/portfolio/' . $newImageName;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        //Toaster Notification
        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.portfolio')->with($notification);
    }
}
