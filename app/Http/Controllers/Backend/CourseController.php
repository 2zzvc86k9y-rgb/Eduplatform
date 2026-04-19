<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Category;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\CourseLecture;
use App\Models\CourseSection;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CourseController extends Controller
{
    //================= user front pages all courses
    public function AllCourses(){
        $courses = Course::latest()->paginate(10);
        return view('frontend.course.all_courses', compact('courses'));

    }//end method allCourses




    public function AllCourse(){
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
        return view('instructor.courses.all_course', compact('courses'));
    }//end method

    // public function AdminAllCourse(){
    //     $id = Auth::user()->id;
    //     $courses = Course::where('instructor_id',$id)->orderBy('id','desc')->get();
    //     return view('instructor.courses.all_course', compact('courses'));
    // }//end method

    public function AddCourse(){
        $categories = Category::latest()->get();
        // $subcategories = SubCategory::all();
        return view('instructor.courses.add_course', compact('categories'));
    }//end method


    public function AdminAddCourse(){
        $categories = Category::latest()->get();
        $subcategories = SubCategory::all();
         return view('admin.backend.adminaddcourse.add_course', compact('categories'));
    }//end method


    // GetSubCategory
    public function GetSubCategory($category_id){
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);

    }




    public function StoreCourse(Request $request){
        $request->validate([
            'video' => 'required|mimes:mp4,webm,ogg,avi,mov,wmv|max:300000',
            'course_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle course image
        $courseImagePath = null;
        if($request->file('course_image')){
            $imageManager = new ImageManager(new Driver()); // No need to pass array configuration
            $imageName = hexdec(uniqid()).'.'.$request->file('course_image')->getClientOriginalExtension();
            $img = $imageManager->read($request->file('course_image'));
            $img->resize(370, 246);

            $courseImagePath = 'upload/course/thumbnail/' . $imageName;


            $img->save(public_path($courseImagePath));
        }

        // Handle video
        $videoPath = null;
        if($request->file('video')){
            $videoName = time().'.'.$request->file('video')->getClientOriginalExtension();
            $videoPath = 'upload/course/video/' . $videoName;

            // Ensure the directory exists
            if (!file_exists(public_path('upload/course/video'))) {
                mkdir(public_path('upload/course/video'), 0777, true);
            }

            $request->file('video')->move(public_path('upload/course/video'), $videoName);
        }

        // Insert course into database
        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'course_title' => $request->course_title,
            'video' => $videoPath,
            'certificate' => $request->certificate,
            'label' => $request->label,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'prerequisites' => $request->prerequisites,
            'description' => $request->description,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $courseImagePath,
            'created_at' => Carbon::now(),
        ]);

        // Insert course goals into database
        $goals = count($request->course_goals);
        if($goals > 0){
            for ($i = 0; $i < $goals; $i++) {
                $Cgoals = new Course_goal();
                $Cgoals->course_id = $course_id;
                $Cgoals->goal_name = $request->course_goals[$i];
                $Cgoals->save(); // Save each goal
            }
        }

        $notification = array(
            'message' => 'Course Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.course')->with($notification);
    }//end method

    public function AdminStoreCourse(Request $request){
        $request->validate([
            'video' => 'required|mimes:mp4,webm,ogg,avi,mov,wmv|max:300000',
            'course_image' => 'required|image|max:2048'
        ]);

        // Handle course image
        $courseImagePath = null;
        if($request->file('course_image')){
            $imageManager = new ImageManager(new Driver()); // No need to pass array configuration
            $imageName = hexdec(uniqid()).'.'.$request->file('course_image')->getClientOriginalExtension();
            $img = $imageManager->read($request->file('course_image'));
            $img->resize(370, 246);

            $courseImagePath = 'upload/course/thumbnail/' . $imageName;


            $img->save(public_path($courseImagePath));
        }

        // Handle video
        $videoPath = null;
        if($request->file('video')){
            $videoName = time().'.'.$request->file('video')->getClientOriginalExtension();
            $videoPath = 'upload/course/video/' . $videoName;

            // Ensure the directory exists
            if (!file_exists(public_path('upload/course/video'))) {
                mkdir(public_path('upload/course/video'), 0777, true);
            }

            $request->file('video')->move(public_path('upload/course/video'), $videoName);
        }

        // Insert course into database
        $course_id = Course::insertGetId([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'course_title' => $request->course_title,
            'video' => $videoPath,
            'certificate' => $request->certificate,
            'label' => $request->label,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'prerequisites' => $request->prerequisites,
            'description' => $request->description,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $courseImagePath,
            'created_at' => Carbon::now(),
        ]);

        // Insert course goals into database
        $goals = count($request->course_goals);
        if($goals > 0){
            for ($i = 0; $i < $goals; $i++) {
                $Cgoals = new Course_goal();
                $Cgoals->course_id = $course_id;
                $Cgoals->goal_name = $request->course_goals[$i];
                $Cgoals->save(); // Save each goal
            }
        }

        $notification = array(
            'message' => 'Course Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.course')->with($notification);
    }//end method


    //start EditCourse
    public function EditCourse($id){
        $categories = Category::latest()->get();
        $goals = Course_goal::where('course_id',$id)->get();
        $subcategories = SubCategory::latest()->get();
        $course = Course::find($id);
        return view('instructor.courses.edit_course', compact('categories','course','subcategories','goals'));
    }//end method

    //========================start UpdateCourse==============
    public function UpdateCourse(Request $request){


        $cid = $request->course_id;

        // Insert course into database
         Course::find($cid)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => Auth::user()->id,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'course_title' => $request->course_title,
            'certificate' => $request->certificate,
            'label' => $request->label,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'prerequisites' => $request->prerequisites,
            'description' => $request->description,
            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,

        ]);

        $notification = array(
            'message' => 'Course Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.course')->with($notification);
    }//end method

    //===================update course image================
    public function UpdateCourseImage(Request $request){
        $course_id = $request->course_id;
        $old_image = $request->old_image;

        // Handle course image
        $courseImagePath = null;
        if ($request->file('course_image')) {
            $imageManager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()) . '.' . $request->file('course_image')->getClientOriginalExtension();
            $img = $imageManager->read($request->file('course_image'));
            $img->resize(370, 246);

            // Save new image
            $courseImagePath = 'upload/course/thumbnail/' . $imageName;
            $img->save(public_path($courseImagePath));

            // Delete old image if it exists
            if (file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }

            // Update course image path in the database
            Course::find($course_id)->update([
                'course_image' => $courseImagePath,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Course Image Updated Successfully',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'No Course Image Uploaded',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }//end method

    //=====================update course video ================
    public function UpdateCourseVideo(Request $request){

        $course_id = $request->video_id;
        $old_video = $request->old_video;


        // Handle video
        $videoPath = null;
        if ($request->file('video')) {
            $videoName = time() . '.' . $request->file('video')->getClientOriginalExtension();
            $videoPath = 'upload/course/video/' . $videoName;


            // Move new video file to the target directory
            $request->file('video')->move(public_path('upload/course/video'), $videoName);

            // Delete old video if it exists
            if (file_exists(public_path($old_video))) {
                unlink(public_path($old_video));
            }

            // Update course video path in the database
            Course::find($course_id)->update([
                'video' => $videoPath, // Corrected key name
                'updated_at' => Carbon::now(),
            ]);

        $notification = array(
            'message' => 'Course Video Updated Successfully',
            'alert-type' => 'success'
        );
        } else {
            $notification = array(
                'message' => 'No Video Uploaded',
                'alert-type' => 'error'
            );
        }

        return redirect()->back()->with($notification); // Ensure this route exists
    }//end method

    //================== Update Course Goals==============
    public function UpdateCourseGoals(Request $request){
        $id = $request->id;

        if($request->course_goals == Null){
            return redirect()->back();
        }else{
            Course_goal::where('course_id', $id)->delete();

            // Insert course goals into database
            $goals = count($request->course_goals);

                for ($i = 0; $i < $goals; $i++) {
                    $Cgoals = new Course_goal();
                    $Cgoals->course_id = $id;
                    $Cgoals->goal_name = $request->course_goals[$i];
                    $Cgoals->save(); // Save each goal
                }

        }

        $notification = array(
            'message' => 'Course Goals Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
 // ======================= End Update Course Goals =====================

    // =======================Delete Course =====================
    public function deleteCourse($id){
        $course = Course::find($id);
        unlink($course->course_image);
        unlink($course->video);

        Course::find($id)->delete();

        $goalsData = Course_goal::where('course_id',$id)->get();
        foreach($goalsData as $item){
            $item->goal_name;
            Course_goal::where('course_id',$id)->get();
        }

        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'danger'
        );

        return redirect()->route('all.course')->with($notification);
    }
     // =======================End Delete Course =====================



//================================================================================================
//                                add course section and lecture                                 //
//================================================================================================


public function AddCourseLecture($id){
    $course = Course::find($id);
    $section = CourseSection::where('course_id',$id)->latest()->get();
    return view('instructor.courses.section.add_course_lecture', compact('course','section'));
}// add course section and lecture

public function AddCourseSection(Request $request){
    $cID = $request->id;
    CourseSection::insert([
        'course_id' => $cID,
        'section_title'=> $request->section_title,
    ]);
    $notification = array(
        'message' => 'Course Section Added Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}

public function SaveLecture(Request $request){
    $lecture = new CourseLecture();

    $lecture->course_id = $request->course_id;
    $lecture->section_id = $request->section_id;
    $lecture->lecture_title = $request->lecture_title;
    $lecture->content = $request->content;

    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course_videos'), $videoName);
        $lecture->video = 'upload/course_videos/' . $videoName;
    }

    $lecture->save();

    return response()->json(['success' => 'Leçon ajoutée avec succès']);
}//end method

public function EditLecture($id){

    $lecture = CourseLecture::find($id);
    return view('instructor.courses.lecture.edit_course_lecture',compact('lecture'));
}

//=========================================UpdateCourseLecture
public function UpdateCourseLecture(Request $request){
    $lectureid = $request->id;
    $lecture = CourseLecture::find($lectureid);

    $lecture->lecture_title = $request->lecture_title;
    $lecture->content = $request->content;

    if ($request->hasFile('video')) {
        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course_videos'), $videoName);
        $lecture->video = 'upload/course_videos/' . $videoName;
    }

    $lecture->save();

    $notification = array(
        'message' => 'Course Lecture Updated Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}//end method

public function DeleteLecture($id){
    CourseLecture::find($id)->delete();

    $notification = array(
        'message' => 'Course Lecture Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);
}//end method

public function DeleteSection($id){
    $section = CourseSection::find($id);
    $section->lectures()->delete($id);
    $section->delete();


    $notification = array(
        'message' => 'Course Section Deleted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->back()->with($notification);

}





}


