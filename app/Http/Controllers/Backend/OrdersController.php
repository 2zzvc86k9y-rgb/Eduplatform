<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\CourseSection;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;

class OrdersController extends Controller
{
    public function AdminPendingOrder(){
        $payment = Payment::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.pending_order',compact('payment'));
    }//end section


    public function AdminOrderDetails($payment_id){
        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('admin.backend.orders.order_details',compact('payment','orderItem'));
    }//end method



    // ordeer pending confirmation
    public function AdminPendingConfirm($payment_id){
        Payment::find($payment_id)->update(['status' => 'Confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.confirm.order')->with($notification);
    }//end method



    // admin confirm order list

    public function AdminConfirmOrder(){
        $payment = Payment::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.backend.orders.confirm_order',compact('payment'));
    }//end section


    public function InstructorAllOrder(){
        $id = Auth::user()->id;
         $latestOrderItem = Order::where('instructor_id',$id)->select('payment_id',\DB::raw('MAX(id) as max_id'))->groupBy('payment_id');
         $orderItem = Order::joinSub( $latestOrderItem,'latest_order', function($join){
            $join->on('orders.id', '=', 'latest_order.max_id');
         })->orderBy('latest_order.max_id', 'DESC')->get();


        return view('instructor.orders.all_order',compact('orderItem'));
    }



    public function InstructorOrderDetails($payment_id){
        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        return view('instructor.orders.order_details',compact('payment','orderItem'));
    }//end method


    // ===================================invoice controller for make pdf =======
    public function InstructorOrderInvoice($payment_id){
        $payment = Payment::where('id',$payment_id)->first();
        $orderItem = Order::where('payment_id',$payment_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('instructor.orders.order_pdf', compact('payment','orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }//end method



    public function MyCourses(){
        $id = Auth::user()->id;
        $latestOrder = Order::where('user_id', $id)
            ->select('course_id', \DB::raw('MAX(id) as max_id'))
            ->groupBy('course_id');

        $myCourse = Order::joinSub($latestOrder, 'latest_order', function($join){
            $join->on('orders.id', '=', 'latest_order.max_id');
            })
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->where('payments.status', 'confirm')
            ->orderBy('latest_order.max_id', 'DESC')
            ->get();

        // Ajout de la progression pour chaque cours (basé sur les leçons)
        foreach ($myCourse as $item) {
            // Nombre total de leçons du cours
            $totalLectures = \App\Models\CourseLecture::where('course_id', $item->course_id)->count();
            // Nombre de leçons terminées par l'utilisateur
            $completedLectures = \App\Models\UserCourseProgress::where('user_id', $id)
                ->where('course_id', $item->course_id)
                ->where('completed', true)
                ->count();
            $item->progress = $totalLectures > 0 ? round(($completedLectures / $totalLectures) * 100) : 0;
        }

        return view('frontend.mycourse.my_all_order', compact('myCourse'));
    }//end method


    public function MyCoursesView($course_id){
        $id = Auth::user()->id;
        $course = Order::where('course_id', $course_id)
                        ->where('user_id', $id)
                        ->with('course.instructor', 'course.coursegoals')
                        ->first();
        $section = CourseSection::where('course_id',$course_id)->orderBy('id','asc')->get();

        $allQuestion = Question::latest()->get();
        
        $quizzes = Quiz::where('course_id', $course->course->id)
            ->get();
        
        // dd($course->course->instructor);
        return view('frontend.mycourse.my_course_view',compact('course','section','allQuestion','quizzes'));
    }//end method


    // Marquer une leçon comme terminée
    public function markLectureComplete(Request $request)
    {
        $userId = Auth::id();
        $courseId = $request->input('course_id');
        $lectureId = $request->input('lecture_id');

        // Vérifier si la progression existe déjà
        $progress = \App\Models\UserCourseProgress::firstOrCreate([
            'user_id' => $userId,
            'course_id' => $courseId,
            'lecture_id' => $lectureId,
        ], [
            'completed' => true,
        ]);

        // Chercher la prochaine leçon
        $lecture = \App\Models\CourseLecture::find($lectureId);
        $nextLecture = \App\Models\CourseLecture::where('section_id', $lecture->section_id)
            ->where('id', '>', $lectureId)
            ->orderBy('id', 'asc')
            ->first();

        $message = 'Leçon marquée comme terminée !';
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'next_lecture_id' => $nextLecture ? $nextLecture->id : null
            ]);
        }
        if ($nextLecture) {
            // Rediriger vers la prochaine leçon
            return redirect()->back()->with('message', $message . ' Passons à la leçon suivante !');
        } else {
            // Dernière leçon de la section ou du cours
            return redirect()->back()->with('message', $message . ' Félicitations, vous avez terminé cette section !');
        }
    }

}
