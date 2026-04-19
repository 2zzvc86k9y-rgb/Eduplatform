<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        $notification = [
            'message' => 'Logout successfully',
            'alert-type' => 'info',
        ];


        return redirect('/admin/login')->with($notification);
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function AdminChangePassword()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename); // Fixing the path here
            $data['photo'] = $filename;
        }
        $data->save();

        // After saving, retrieve the updated profile data again
        // $profileData = $data;

        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function AdminPasswordUpdate(Request $request)
    {
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (! Hash::check($request->old_password, Auth::user()->password)) {
            $notification = [
                'message' => 'Old password does not match',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
            // return back()->with('status', 'password-updated');
        }
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        $notification = [
            'message' => 'Password Successfully Updated',
            'alert-type' => 'success',
        ];

        return back()->with($notification);

    }




    // BecomeInstructor

    public function BecomeInstructor(){
        return view('frontend.instructor.reg_instructor');
    }

    // InstructorRegistration
    public function InstructorRegistration(Request $request){

        $request->validate([
            'name' => ['required','string', 'max:50'],
            'email'=>['required','string', 'unique:users']
         ]);

         User::insert([
             'name' => $request->name,
             'username' => $request->username,
             'email' => $request->email,
             'phone' => $request->phone,
             'address' => $request->address,
             'password' =>  Hash::make($request->password),
             'role' => 'instructor',
            'status' => '0',
         ]);

         $notification = [
            'message' => 'Instructor request send  Successfully ',
            'alert-type' => 'success',
        ];

        return redirect()->route('instructor.login')->with($notification);
    }


    // AllInstructor
    public function AllInstructor(){
        $allinstructor = User::where('role','instructor')->latest()->get();
        return view('admin.backend.instructor.all_instructor',compact('allinstructor'));
    }

    // important code for getting all instructor information

    public function UpdateUserStatus(Request $request)
    {
        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0); // Default to 0 if not provided
        $user = User::find($userId);

        if ($user) {
            $user->status = $isChecked;
            $user->save();
            return redirect()->route('all.instructor');
        }
    }



    //==========================admin can see all users in the admin panel =================

    public function AllCourse(){
        $courses = Course::latest()->get();
        return view('admin.backend.courses.all_course',compact('courses'));
    }


    public function AdminCourseDetails($id){
        $course = Course::find($id);
        return view('admin.backend.courses.course_details',compact('course'));
    }//end method


    // important code for getting all course information

    public function UpdateCourseStatus(Request $request)
    {
        $courseId = $request->input('course_id');
        $isChecked = $request->input('is_checked', 0); // Default to 0 if not provided
        $course = Course::find($courseId);

        if ($course) {
            $course->status = $isChecked;
            $course->save();
            return redirect()->route('admin.all.courses');
        }
    }

////////////////====================== Manage all admin super admin Manager ================
    public function AdminManageAllAdmin(){
        $alladmin = User::where('role', 'admin')->get();
        return view('admin.backend.pages.admin.all_admin',compact('alladmin'));
    }//end method

    public function AdminAddAdmin(){
        $roles = Role::all();
        return view('admin.backend.pages.admin.add_admin', compact('roles'));
    }//end method

    public function AdminStoreAdminData(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password =  Hash::make($request->password);
        $user->role = 'admin';
        $user->status = '1';
        $user->save();

        if ($request->role) {
            $role = Role::findById($request->role);
            if ($role) {
                $user->assignRole($role->name);
            }
        }
        $notification = [
            'message' => 'New Admin Inserted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.all.admin')->with($notification);
    }//end method

    public function EditAdmin($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.backend.pages.admin.edit_admin',compact('user','roles'));

    }//end method

    public function AdminUpdateData(Request $request,$id){
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = '1';
        $user->save();
        $user->roles()->detach();
        if ($request->role) {
            $role = Role::findById($request->role);
            if ($role) {
                $user->assignRole($role->name);
            }
        }
        $notification = [
            'message' => 'New Admin Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.all.admin')->with($notification);
    }//end method

    public function DeleteAdmin($id){
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = [
            'message' => 'Admin Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('manage.all.admin')->with($notification);
    }






}
