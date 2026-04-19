<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;

use App\Models\Course;
use App\Models\Category;
use App\Models\WishList;
use App\Models\Course_goal;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\CourseLecture;
use App\Models\CourseSection;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class WishListController extends Controller
{
    public function AddToWishList(Request $request, $course_id) {
        if (Auth::check()) {
            $exists = WishList::where('user_id', Auth::id())->where('course_id', $course_id)->first();
    
            if (!$exists) {
                WishList::insert([
                    'user_id' => Auth::id(),
                    'course_id' => $course_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Course added to wishlist'], 200); // 200 OK
            } else {
                return response()->json(['error' => 'This Course has already been added to the wishlist'], 409); // 409 Conflict
            }
        } else {
            return response()->json(['error' => 'Please login first'], 401); // 401 Unauthorized
        }
    }//end method 


    public function AllWishList(){
        $profileData = User::where('id', Auth::id())->first();
        return view('frontend.wishlist.all_wishlist',compact('profileData'));
    }//end method

    public function GetWishListCourse(){
        $wishList = WishList::with('course')->where('user_id', Auth::id())->latest()->get();
        $wishlistquantity = WishList::count();
        return response()->json(['wishlist' => $wishList, 'wishlistquantity' => $wishlistquantity]);
    }
    

    public function RemoveWishList($id){
        WishList::where('user_id', Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Course remove from wishlist'], 200); // 200 OK
    }//end method





}
