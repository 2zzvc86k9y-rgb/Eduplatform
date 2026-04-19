<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function StoreReview(Request $request){
        $course = $request->course_id;
        $instructor = $request->instructor_id;

        $request->validate([
            'comment' => 'required',
        ]);
        Review::insert([
            'course_id' => $course,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rate,
            'instructor_id' => $instructor,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Your review have send Successfully and admin will approve it.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



    // admin review list pending
    public function AdminPendingReview(){
        $review = Review::where('status', 0)->orderBy('id','desc')->get();
        return view('admin.backend.review.pending_review', compact('review'));
    }



      // important code for getting all instructor information

      public function UpdateReviewStatus(Request $request)
      {
          $reviewId = $request->input('review_id');
          $isChecked = $request->input('is_checked', 0); // Default to 0 if not provided
          $review = Review::find($reviewId);

          if ($review) {
              $review->status = $isChecked;
              $review->save();
              $notification= array(
                'message' => 'Review updated Successfully',
                'alert-type' =>'success'
            );
              return redirect()->route('admin.pending.review')->with($notification);
          }
      }//end method


      public function AdminActiveReview(){
        $review = Review::where('status', 1)->orderBy('id','desc')->get();
        return view('admin.backend.review.active_review', compact('review'));
      }//end method


      public function InstructorAllReview(){
        $id = Auth::user()->id;
        $review = Review::where('instructor_id',$id)->where('status',1)->orderBy('id','desc')->get();
        return view('instructor.review.active_review', compact('review'));
      }




}
