<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApproverController extends Controller
{
   //approver to approve request
   public function approveRequest($req_id)
   {
      $approve_request = DB::table('requests')->select('*')->where(['request_id' => $req_id])
      ->update([
         'request_status'        => 'pending to manager',
         'supervisor_approval'   => 1,
      ]);

      if (!$approve_request) {

         toastr()->error('An error occurred, please contact your administrator');
         return redirect()->route('approver.home');

      } else {

         toastr()->success('Request marked as approved');
         return redirect()->route('approver.home');
      }
   }

   public function approverApproved(){
      $approved_requests = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_supervisor'=> Auth::user()->name,'supervisor_approval'=>1])->get();
      return view('pages.approver.approver_approved_req')->with(['approved_req' => $approved_requests]);
   }


   //approver to request
   public function approverPendingForApproval(){
      $for_approval = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->whereIn('requestor',[Auth::id()])->whereIn('request_status',['pending to manager'])->get();
      return view('pages.approver.approver_pending_approval')->with(['for_approval'=>$for_approval]);
   }

   public function approverPendingRequest(){
      $pending = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->whereIn('requestor',[Auth::id()])->whereIn('request_status',['pending'])->get();
      return view('pages.approver.approver_pending_request')->with(['pending_request'=>$pending]);
   }

   public function approverCompletedRequest(){
      $completed = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->whereIn('requestor',[Auth::id()])->whereIn('request_status',['completed'])->get();
      return view('pages.approver.approver_completed_request')->with(['completed'=>$completed]);
   }

   public function approverEEreqForm()
   {
      $get_all_manager       = User::select('*')->where(['role'=>3,'department'=>'EQUIPMENT ENGINEERING'])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      return view('pages.approver.forms.approver_ee_req_form')
      ->with([
         'get_all_manager'    => $get_all_manager, 
         'get_all_department' => $get_all_department,
      ]);
   }

   public function approverPMreqForm()
   {
      $get_all_manager       = User::select('*')->where(['role'=>3,'department'=>'PLANT MAINTENANCE'])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      return view('pages.approver.forms.approver_pm_req_form')
      ->with([
         'get_all_manager'    => $get_all_manager, 
         'get_all_department' => $get_all_department,
      ]);
   }

   public function approverPEreqForm()
   {
      $get_all_manager       = User::select('*')->where(['role'=>3,'department'=>'PROCESS ENGINEERING'])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      return view('pages.approver.forms.approver_pe_req_form')
      ->with([
         'get_all_manager'    => $get_all_manager, 
         'get_all_department' => $get_all_department,
      ]);
   }

   public function approverReqDetails($req_id)
   {
      $get_req_details = DB::table('requests')->select('*')->where(['request_id'=> $req_id])->get();
      return view('pages.approver.forms.approver_req_details')->with(['get_request_details'=>$get_req_details]);
   }
}
