<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function allBlogCategory()
    {
        $blogCategory = BlogCategory::latest()->get();
        return view('admin.blog_category.all_blog_category', compact('blogCategory'));
    }

    public function addBlogCategory()
    {
        return view('admin.blog_category.add_blog_category');
    }

    public function storeBlogCategory(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ], [
            'category.required' => 'Blog Category Name is Required',
        ]);

        BlogCategory::insert([
            'category' => $request->category,
            'created_at' => Carbon::now(),
        ]);

        //Toaster Notification
        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function editBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id);
        return view('admin.blog_category.edit_block_category', compact('blogCategory'));
    }

    public function updateBlogCategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ], [
            'category.required' => 'Blog Category Name is Required',
        ]);

        BlogCategory::findOrFail($id)->update([
            'category' => $request->category,
        ]);

        //Toaster Notification
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog.category')->with($notification);
    }

    public function deleteBlogCategory($id)
    {
        $blogCategory = BlogCategory::findOrFail($id)->delete();

        //Toaster Notification
        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
