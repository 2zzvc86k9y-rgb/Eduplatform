<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Cupon;
use App\Models\Category;
use App\Models\Course_goal;
use App\Models\SubCategory;

use App\Models\CourseLecture;
use App\Models\CourseSection;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CuponController extends Controller
{
    public function AllCupon(){
        $cupons = Cupon::latest()->get();
        return view('admin.backend.cupon.all_cupon',compact('cupons'));
    }//end methods


    public function AdminAddCupon(){
        return view('admin.backend.cupon.admin_add_cupon');
    }


    public function AdminStoreCupon(Request $request){
        Cupon::insert([
            'cupon_name' => strtoupper($request->cupon_name),
            'cupon_discount' => $request->cupon_discount,
            'cupon_validity' => $request->cupon_validity,
            'created_at'=> Carbon::now(),

        ]);
        $notification= array(
            'message' => 'Cupon Added Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.all.cupon')->with($notification);
    }



    public function AdminEditCupon($id){
        $cupon = Cupon::find($id);
        return view('admin.backend.cupon.admin_edit_cupon',compact('cupon'));
    }


    public function AdminUpdateCupon(Request $request){
        $cupon_id = $request->id;

        Cupon::find($cupon_id)->update([
            'cupon_name' => $request->cupon_name,
            'cupon_discount' => $request->cupon_discount,
            'cupon_validity' => $request->cupon_validity,


        ]);
        $notification= array(
            'message' => 'Cupon Updated  Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.all.cupon')->with($notification);
    }//end method


    public function AdminDeleteCupon($id){
        Cupon::find($id)->delete();
        $notification= array(
            'message' => 'Cupon Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.all.cupon')->with($notification);
    }//end method



    //======================================instructor all coupon routes methods

    public function InstructorAllCupon(){
        $id = Auth::user()->id;
        $cupons = Cupon::where('instructor_id', $id)->latest()->get();
        return view('instructor.cupon.all_cupon', compact('cupons'));
    }

    public function InstructorAddCupon(){
        $id = Auth::user()->id;
        $courses = Course::where('instructor_id', $id)->get();
        return view('instructor.cupon.instructor_add_cupon', compact('courses'));
    }//end methodInstructorAddCupon

    public function InstructorStoreCupon(Request $request){
        Cupon::insert([
            'cupon_name' => strtoupper($request->cupon_name),
            'cupon_discount' => $request->cupon_discount,
            'instructor_id' => Auth::user()->id,
            'course_id' => $request->course_id,
            'cupon_validity' => $request->cupon_validity,
            'created_at'=> Carbon::now(),

        ]);
        $notification= array(
            'message' => 'Cupon Inserted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('instructor.all.cupon')->with($notification);
    }//end method

    public function InstructorEditCupon($id){
        $cupon = Cupon::find($id);
        $instructor_id = Auth::user()->id;
        $courses = Course::where('instructor_id', $instructor_id)->get();
        return view('instructor.cupon.instructor_edit_cupon',compact('cupon','courses'));
    }

    public function InstructorUpdateCupon(Request $request){
        $cupon_id = $request->cupon_id;

        Cupon::find($cupon_id)->update([
            'cupon_name' => $request->cupon_name,
            'cupon_discount' => $request->cupon_discount,
            'cupon_validity' => $request->cupon_validity,
            'instructor_id' => Auth::user()->id,
            'course_id' => $request->course_id,


        ]);
        $notification= array(
            'message' => 'Cupon Updated  Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('instructor.all.cupon')->with($notification);

    }//end method 

    public function InstructorDeleteCupon($id){
        Cupon::find($id)->delete();
        $notification= array(
            'message' => 'Cupon Deleted Successfully',
            'alert-type' =>'success'
        );
        return redirect()->route('instructor.all.cupon')->with($notification);
    }
}
