<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function AllBlogCategory(){
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category',compact('categories'));
    }//end method


    public function BlogCategoryStore(Request $request){
        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_at' => Carbon::now(),
        ]);
        $notification= array(
            'message' => 'Blog Category Added Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }//end method


    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }

    public function BlogCategoryUpdate(Request $request){
        $cat_id = $request->cat_id;
        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'created_at' => Carbon::now(),
        ]);
        $notification= array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }



     // delete category
     public function DeleteCategoryUpdate($id){

        BlogCategory::find($id)->delete();


        $notification= array(
           'message' => 'Blog Category Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }//end method



    // ==========================blog post releted all methods bellow ==============================
    public function AllBlogPost(){
       $posts = BlogPost::latest()->get();
       return view('admin.backend.blogpost.all_blog_post',compact('posts'));
    }//end method

    public function AddBlogPost(){
        $blogCat = BlogCategory::latest()->get();
        return view('admin.backend.blogpost.add_blog_post',compact('blogCat'));
    }//end method

    public function StoreBlogPost(Request $request){
        $manager = new ImageManager(new Driver());

        $name_gen = hexdec(uniqid()).'.'.$request->file('post_image')->getClientOriginalExtension();
        $img = $manager->read($request->file('post_image'));
        $img->resize(370,247);
        $save_url = 'upload/post/' . $name_gen;
        $img->save(public_path($save_url));

        BlogPost::insert([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
            'post_image' => $save_url,
            'long_description' => $request->long_description,
            'post_tags' => $request->post_tags,
            'created_at' => Carbon::now(),
        ]);
        $notification= array(
            'message' => 'Blog Post Added Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('blog.posts')->with($notification);
    }//end method

    public function EditBlogPost($id){
        $post = BlogPost::find($id);
        $blogCat = BlogCategory::latest()->get();
        return view('admin.backend.blogpost.edit_blog_post',compact('post','blogCat'));
    }//end method

    public function UpdateBlogPost(Request $request){
        $post_id = $request->id;
        $blogPost = BlogPost::find($post_id);

        if($request->file('post_image')){
            // If a new image is uploaded, delete the old image
            if (file_exists($blogPost->post_image)) {
                unlink($blogPost->post_image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('post_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('post_image'));
            $img->resize(370, 247);

            $save_url = 'upload/post/' . $name_gen;
            $img->save(public_path($save_url));

            // Update the category with the new image URL
            $blogPost->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'post_image' => $save_url,
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
                'updated_at' => Carbon::now(),
            ]);

            $notification= array(
                'message' => 'Blog Post Updated with image Successfully',
                'alert-type' =>'success'
            );

            return redirect()->route('blog.posts')->with($notification);
        } else {
            // If no new image is uploaded, update the category without changing the image
            $blogPost->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_description' => $request->long_description,
                'post_tags' => $request->post_tags,
                'updated_at' => Carbon::now(),
            ]);

            $notification= array(
                'message' => 'Blog Post updated without image Successfully',
                'alert-type' =>'success'
            );

            return redirect()->route('blog.posts')->with($notification);
        }
    }//end method

    // DeleteBlogPost
    public function DeleteBlogPost($id){
        BlogPost::find($id)->delete();


        $notification= array(
           'message' => 'SubCategory Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->back()->with($notification);
    }// end method



    public function BlogDetailsPage($slug){
        $post = BlogPost::where('post_slug',$slug)->first();
        $tags = $post->post_tags;
        $tag = explode(',',$tags);
        $blogCategory = BlogCategory::latest()->get();
        $postblog = BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_post_details',compact('post','tag','blogCategory','postblog'));
    }//end method

    public function BlogCategoryList($id){
        $blog = BlogPost::where('blogcat_id',$id)->paginate(8);
        $postblog = BlogPost::latest()->limit(3)->get();
        $blogCategory = BlogCategory::latest()->get();
        $blogCat = BlogCategory::where('id',$id)->first();
        return view('frontend.blog.blog_category_list',compact('blog','postblog','blogCategory','blogCat'));
    }//end methoed

    public function ViewAllPost(){
        // $blog = BlogPost::latest()->paginate(8);
        // $postblog = BlogPost::latest()->limit(3)->get();
        // $blogCategory = BlogCategory::latest()->get();
        return view('frontend.blog.view_all_post');
    }
    public function ViewAllPosts(){
        $blog = BlogPost::latest()->paginate(8);
        $postblog = BlogPost::latest()->limit(3)->get();
        $blogCategory = BlogCategory::latest()->get();
        return view('frontend.blog.all_blog_post',compact('blog','postblog','blogCategory'));
    }

}
