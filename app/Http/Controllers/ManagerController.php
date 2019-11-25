<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Toaster;

class ManagerController extends Controller
{

   public function managerPendingForApproval(){
      $for_approval = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_manager'=> Auth::user()->name,'request_status'=>'pending to manager'])->get();
      return view('pages.manager.manager_pending_approval')->with(['for_approval'=>$for_approval]);
   }

   public function approveRequest($req_id){
      $approve_request = DB::table('requests')->select('*')->where(['request_id'=> $req_id])
      ->update([
         'request_status'     => 'pending',
         'manager_approval'   => 1
      ]);

      if (!$approve_request) {

         toastr()->error('An error occurred, please contact your administrator');
         return redirect()->route('manager.pending_for_approval');

      } else {

         toastr()->Success('Request marked as approved');
         return redirect()->route('manager.pending_for_approval');

      }
   }

   public function managerApproved(){
      $approved_requests = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_manager'=> Auth::user()->name,'manager_approval'=>1])->get();
      return view('pages.manager.manager_approved_req')->with(['approved_req' => $approved_requests]);
   }

   public function managerReqDetails($req_id){
      $get_req_details = DB::table('requests')->select('*')->where(['request_id'=> $req_id])->get();
      return view('pages.manager.forms.manager_req_details')->with(['get_request_details'=>$get_req_details]);
   }
}
