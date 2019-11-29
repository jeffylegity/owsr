<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Toaster;

class ManagerController extends Controller
{

   public function managerPendingForApproval(){
      return view('pages.manager.manager_pending_approval')
         ->with(managerParameters());
   }

   public function approveRequest($req_id){
      $approve_request = DB::table('requests')->select('*')->where(['request_id'=> $req_id])
      ->update([
         'request_status'     => 'pending',
         'manager_approval'   => 1,
      ]);

      if (!$approve_request) {

         toastr()->error('An error occurred, please contact your administrator');
         return redirect()
            ->route('manager.pending_for_approval');

      } else {

         toastr()->Success('Request marked as approved');
         return redirect()
            ->route('manager.pending_for_approval');
      }
   }

   public function managerApproved(){
      return view('pages.manager.manager_approved_req')
         ->with(managerParameters());
   }

   public function managerReqDetails($req_id){
      return view('pages.manager.forms.manager_req_details')
         ->with(['get_request_details'=>getManagerReqDetails($req_id),'for_approval_counter'=>getManagerForApprovalCounter()]);
   }
}
