<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use App\Models\Course_goal;
use App\Models\SubCategory;


use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class IndexController extends Controller
{
    //=============================course details page show
    public function CourseDetails($id,$slug){
        $course = Course::find($id);
        $instructor_id = $course->instructor_id;
        $instructorAllCourses = Course::where('instructor_id',$instructor_id)->orderBy('id','desc')->get();
        $goals=Course_goal::where('course_id',$id)->orderBy('id','DESC')->get();
        $categories = Category::latest()->get();

        $catId = $course->category_id;
        $relatedCourses = Course::where('category_id',$catId)->where('id', '!=',$id)->orderBy('id','DESC')->get();


        return view('frontend.course.course_details', compact('course','goals','instructorAllCourses','categories','relatedCourses'));

    }//end method 

    public function CategoryCourse($id,$slug){
        $courses = Course::where('category_id',$id)->where('status','1')->get();
        $category = Category::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.category_all', compact('category','courses','categories'));
    }//end method 

    public function SubCategoryCourse($id,$slug){
        $courses = Course::where('subcategory_id',$id)->where('status','1')->get();
        $subcategory = SubCategory::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.subcategory_all', compact('subcategory','courses','categories'));


        //{{ url('subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}
    }//end method

    public function InstructorDetails($id){
        $instructor = User::find($id);
        $courses = Course::where('instructor_id',$id)->get();

        return view('frontend.instructor.instruction_details',compact('courses','instructor'));
    }
}
