<?php

namespace App\Http\Controllers\Backend;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuestionController extends Controller
{
    public function UserQuestion(Request $request){
        $course_id = $request->course_id;
        $instructor_id = $request->instructor_id;

        Question::insert([
            'course_id' => $course_id,
            'user_id' => Auth::user()->id,
            'instructor_id' => $instructor_id,
            'subject' => $request->subject,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Question Submitted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }//end method

    public function InstructorAllQuestions(){
        $id= Auth::user()->id;

        $question = Question::where('instructor_id',$id)->where('parent',null)->orderBy('id','desc')->get();
        return view('instructor.question.all_questions',compact('question'));
    }//end method 

    public function InstructorQuestionDetails($id){
        $question = Question::find($id);
        $reply = Question::where('parent',$id)->orderBy('id','asc')->get();

        return view('instructor.question.question_details',compact('question','reply'));
    }//end method 


    public function InstructorReply(Request $request){
        $qid = $request->qid;
        $course_id = $request->course_id;
        $user_id = $request->user_id;
        $instructor_id = $request->instructor_id;


        Question::insert([
            'course_id' => $course_id,
            'instructor_id' => $instructor_id,
            'user_id' => $user_id,
            'parent' => $qid,
            'question' => $request->question,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Message Send Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.questions')->with($notification);
    }

}
