<?php

namespace App\Http\Controllers\Backend;

use DateTime;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function AllReportView(){
        return view('admin.backend.report.report_view');
    }//end method 

    public function AdminSearchByDate(Request $request){
        $date = new DateTime($request->date);
        $formateDate = $date->format('d-F-Y');

        $payment = Payment::where('order_date', $formateDate)->latest()->get();

        $notification = array(
            'message' => 'Daily Report Shows Successfully',
            'alert-type' => 'success'
        );
        return view('admin.backend.report.report_by_date', compact('payment','formateDate'))->with($notification);
    }//end method

    public function AdminSearchByMonth(Request $request){
        $month = $request->month;
        $year = $request->year_name;
        $payment = Payment::where('order_month', $month)->where('order_year',$year)->latest()->get();
        $notification = array(
            'message' => 'Monthly Report Shows Successfully',
            'alert-type' => 'success'
        );
        return view('admin.backend.report.report_by_month', compact('payment','month','year'))->with($notification);
    }//end method

    public function AdminSearchByYear(Request $request){
        $year = $request->year;
        $payment = Payment::where('order_year', $year)->latest()->get();
        $notification = array(
            'message' => 'Yearly Report Shows Successfully',
            'alert-type' => 'success'
        );
        return view('admin.backend.report.report_by_year', compact('payment','year'))->with($notification);
    }//end method
}
