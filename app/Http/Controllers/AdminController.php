<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
 
class AdminController extends Controller
{
   public function adminPendingRequests(){
      return view('pages.admin.admin_pending_request')
         ->with(adminParameters());
   }

   public function adminCompletedRequest(){
      return view('pages.admin.admin_completed_request')
         ->with(adminParameters());
   }

   public function adminDeniedRequest(){
      return view('pages.admin.admin_denied_request')
         ->with(adminParameters());
   }

   public function adminReqDetails($req_id){
      $get_req_details = DB::table('requests')->select('*')->where(['request_id'=> $req_id])->get();
      return view('pages.admin.forms.admin_req_details')->with(['get_request_details'=>$get_req_details])->with(adminParameters());
   }

   public function adminCompleteRequest($req_id){
      $complete_request = DB::table('requests')->select('*')
         ->where([
            'request_id'   =>$req_id
         ])
         ->update([
            'request_status'=>'completed'
         ]);

      if (!$complete_request) {

         toastr()->error('An error occurred, please contact your administrator');
         return redirect()->route('admin.pending_requests');

      } else {

         toastr()->success('Task marked as Completed');
         return redirect()->route('admin.pending_requests');

      }
   }

   public function adminDenyRequest(Request $request){

      $req_id        = $request->input('req_id');
      $input_form    = $request->input('denyTask');

      $deny_request  = DB::table('requests')->select('*')
         ->where([
            'request_id'   =>$req_id
         ])
         ->update([
            'remarks'         =>$input_form,
            'request_status'  =>'denied',
         ]);

      if (!$deny_request) {

         toastr()->error('An error occurred, please contact your administrator');
         return redirect()->route('admin.pending_requests');

      } else {

         toastr()->error('Task denied');
         return redirect()->route('admin.pending_requests');

      }
   }

}
