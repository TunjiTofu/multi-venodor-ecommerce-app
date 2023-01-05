<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\MultiImage;
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

    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blogCategories = BlogCategory::orderBy('category', 'ASC')->get();
        return view('admin.blog.edit_blog', compact('blog', 'blogCategories'));
    }

    public function updateBlog(Request $request)
    {
        $blogId = $request->id;

        if ($request->file('image')) {
            $image = $request->file('image');
            $newImageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            //resize with laravel image intervention
            Image::make($image)->resize(430, 327)->save('upload/blog/' . $newImageName);
            $saveUrl = 'upload/blog/' . $newImageName;

            Blog::findOrFail($blogId)->update([
                'blog_category_id' => $request->category,
                'blog_title' => $request->title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->description,
                'blog_image' => $saveUrl,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'Blog Data Updated With Image Successfully',
                'alert-type' => 'success',
            );

            return redirect()->route('all.blog')->with($notification);
        } else {
            Blog::findOrFail($blogId)->update([
                'blog_category_id' => $request->category,
                'blog_title' => $request->title,
                'blog_tags' => $request->tags,
                'blog_description' => $request->description,
            ]);

            //Toaster Notification
            $notification = array(
                'message' => 'Blog Updated Successfully Without Image',
                'alert-type' => 'success',
            );

            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function deleteBlog($id)
    {
        $blogId = Blog::findOrFail($id);
        $image = $blogId->blog_image;
        unlink($image);

        $blogId->delete();

        //Toaster Notification
        $notification = array(
            'message' => 'Blog Data Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function detailsBlog($id)
    {
        $recentBlogs = Blog::latest()->limit(5)->get();
        $blog = Blog::findOrFail($id);
        $blogCategories = BlogCategory::orderBy('category', 'ASC')->get();
        $multiImages = MultiImage::all();
        return view('frontend.blog', compact('blog','multiImages','recentBlogs','blogCategories'));
    }
}
