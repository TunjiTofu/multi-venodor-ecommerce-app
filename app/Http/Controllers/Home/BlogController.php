<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function allBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blog.all_blog', compact('blogs'));
    }

    public function addBlog()
    {
        $blogCategories = BlogCategory::orderBy('category', 'ASC')->get();
        return view('admin.blog.add_blog', compact('blogCategories'));
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'image' => 'required',
        ], [
            'category.required' => 'Category is Required',
            'title.required' => 'Title is Required',
            'tags.required' => 'Tags is Required',
            'description.required' => 'Description is Required',
            'image.required' => 'Image Must be Selected is Required',
        ]);

        $image = $request->file('image');
        $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        //resize with laravel image intervention
        Image::make($image)->resize(430, 327)->save('upload/blog/' . $newImageName);
        $saveUrl = 'upload/blog/' . $newImageName;

        Blog::insert([
            'blog_category_id' => $request->category,
            'blog_title' => $request->title,
            'blog_tags' => $request->tags,
            'blog_description' => $request->description,
            'blog_image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        //Toaster Notification
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.blog')->with($notification);
    }
}
