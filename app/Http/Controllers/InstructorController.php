<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function InstructorDashboard()
    {
        return view('instructor.index');
    }

    public function InstructorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Logout successfully',
            'alert-type' => 'info',
        ];

        return redirect('/instructor/login')->with($notification);
    }

    public function InstructorLogin()
    {
        return view('instructor.instructor_login');
    }

    public function InstructorProfile()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('instructor.instructor_profile_view', compact('profileData'));
    }

    public function InstructorChangePassword()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('instructor.instructor_change_password', compact('profileData'));
    }

    public function InstructorProfileStore(Request $request)
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
            @unlink(public_path('upload/instructor_image/'.$data->photo));
            $filename = date('Ymdhi').$file->getClientOriginalName();
            $file->move(public_path('upload/instructor_image'), $filename); // Fixing the path here
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

    public function InstructorPasswordUpdate(Request $request)
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
}
