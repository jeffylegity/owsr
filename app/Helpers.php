<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Charts\ManagerBarChart;
use App\Charts\ManagerPieChart;
use Prophecy\Exception\Doubler\ReturnByReferenceException;

//Admin Helpers
function adminParameters(){
   $array = array(
      'pending_counter'     =>getAdminPendingCounter(),
      'ongoing_counter'     =>getAdminOngoingCounter(),
      'completed_counter'   =>getAdminCompletedCounter(),
      'pending_requests'    =>getAdminPendingRequests(),
   );
   return $array;
}

function getAdminPendingCounter(){
   $pending_counter = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'pending',
         ])
      ->count();
   return $pending_counter;
}

function getAdminOngoingCounter(){
   $ongoing_counter = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'ongoing',
         ])
      ->count();
   return $ongoing_counter;
}

function getAdminCompletedCounter(){
   $completed_counter = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'completed'
         ])
      ->count();
   return $completed_counter;
}

function getAdminPendingRequests(){
   $pending_requests = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'pending',
      ])
      ->get();
   return $pending_requests;
}

//Manager Helpers
function getManagerForApproval(){
   $for_approval = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->where(['route_to_manager'=> Auth::user()->name,'request_status'=>'pending to manager'])
      ->get();
   return $for_approval;
}

function getManagerForApprovalCounter(){
   $for_approval_counter = DB::table('requests')->select('*')
      ->where(['route_to_manager'=> Auth::user()->name,'request_status'=>'pending to manager'])
      ->count();
   return $for_approval_counter;
}

function getManagerPendingCounter(){
   $pending_counter = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'pending'])
      ->count();
   return $pending_counter;
}

function getManagerCompletedCounter(){
   $completed_counter = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'completed'])
      ->count();
   return $completed_counter;
}

function getManagerApprovedRequests(){
   $approved_requests = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->where(['route_to_manager'=> Auth::user()->name,'manager_approval'=>1])
      ->get();
   return $approved_requests;
}

function getManagerReqDetails($req_id){
   $get_req_details = DB::table('requests')->select('*')
      ->where(['request_id'=> $req_id])
      ->get();
   return $get_req_details;
}

function managerParameters(){
   $array = array(
      'for_approval'          =>getManagerForApproval(),
      'approved_req'          =>getManagerApprovedRequests(),
      'for_approval_counter'  =>getManagerForApprovalCounter(),
      'pending_counter'       =>getManagerPendingCounter(),
      'completed_counter'     =>getManagerCompletedCounter()
   );
   return $array;
}

function managerMonthlyActivity(){
   $monthlyActivity = new ManagerBarChart;
   $monthlyActivity->height(0);
   $monthlyActivity->width(0);
   $main = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>'MAIN PLANT',
         'request_status'     =>'PENDING',
         'request_to'         =>Auth::user()->department,
      ])->count();
   $plant7 = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>'PLANT 7',
         'request_status'     =>'PENDING',
         'request_to'         =>Auth::user()->department,
      ])->count();
   $plant8 = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>'PLANT 8/9/10',
         'request_status'     =>'PENDING',
         'request_to'         =>Auth::user()->department,
      ])->count();

   // array($main,$plant7,$plant8)
   $monthlyActivity->labels(['Main Plant','Plant 7','Plant 8']);
   $monthy_data = $monthlyActivity->dataset('All Pending Requests per Plant', 'bar', array(14,2,10));
   $monthy_data->backgroundColor(collect(['#f9c851','#f9c851','#f9c851']));
   return $monthlyActivity;
}

function managerTaskOverview(){
   $all_pending   = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'pending'])
      ->count();
   $all_completed = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'completed'])
      ->count();
   
   $taskOverview = new ManagerPieChart;
   $taskOverview->displayAxes(false);
   $taskOverview->height(0);
   $taskOverview->width(0);
   $taskOverview->labels(['Pending','Completed']);
   $dataset = $taskOverview->dataset('Task Overview', 'doughnut', array($all_pending,$all_completed));
   $dataset->backgroundColor(collect(['#f9c851','#10c469']));
   return $taskOverview;
}

//Approver Helpers
function approverParameters(){
   $array = array(
      'for_approval_counter'     =>getApproverPendingForApprovalCounter(),
      'pending_request_counter'  =>getApproverPendingForApprovalRequestsCounter(),
      'pending_counter'          =>getApproverPendingRequestsCounter(),
      'for_approval_requests'    =>getApproverPendingForApproval(),
      'approved_req'             =>getApproverApprovedRequests(),
      'for_approval'             =>getApproverPendingForApprovalRequests(),
      'pending_request'          =>getApproverPendingRequests(),
      'completed'                =>getApproverCompletedRequests(),
   );
   return $array;
}

function getApproverPendingForApprovalCounter(){
   $for_approval_counter = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->where(['route_to_supervisor'=> Auth::user()->name,'request_status'=>'pending to supervisor'])
      ->count();
   return $for_approval_counter;
}

function getApproverPendingForApprovalRequestsCounter(){
   $for_approval_requests_counter = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->whereIn('requestor',[Auth::id()])
      ->whereIn('request_status',['pending to manager'])
      ->count();
   return $for_approval_requests_counter;
}

function getApproverPendingRequestsCounter(){
   $pending_requests_counter = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->whereIn('requestor',[Auth::id()])
      ->whereIn('request_status',['pending'])
      ->count();
   return $pending_requests_counter;
}

function getApproverPendingForApproval(){
   $for_approval = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->where(['route_to_supervisor'=> Auth::user()->name,'request_status'=>'pending to supervisor'])
      ->get();
   return $for_approval;
}

function getApproverApprovedRequests(){
   $approved_requests = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->where(['route_to_supervisor'=> Auth::user()->name,'supervisor_approval'=>1])
      ->get();
   return $approved_requests;
}

function getApproverPendingForApprovalRequests(){
   $for_approval_requests = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->whereIn('requestor',[Auth::id()])
      ->whereIn('request_status',['pending to manager'])
      ->get();
   return $for_approval_requests;
}

function getApproverPendingRequests(){
   $pending_requests = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->whereIn('requestor',[Auth::id()])
      ->whereIn('request_status',['pending'])
      ->get();
   return $pending_requests;
}

function getApproverCompletedRequests(){
   $completed_requests = DB::table('requests')->select('*')
      ->leftJoin('users','requests.requestor', '=', 'users.id')
      ->whereIn('requestor',[Auth::id()])
      ->whereIn('request_status',['completed'])
      ->get();
   return $completed_requests;
}

//User Helpers
function userParameters(){
   $array = array(
      'completed'                      =>getUserCompletedRequests(),
      'pending'                        =>getUserPendingRequests(),
      'pending_for_approval_counter'   =>getUserPendingForApprovalCounter(),
      'pending_counter'                =>getUserPendingRequestCounter(),
   );
   return $array;
}

function getUserPendingRequests(){
   $pending_requests = DB::table('requests')->select('*')
      ->where([
         'requestor'=>Auth::id(),
         'request_status'=>'pending'
      ])->get();
   return $pending_requests;
}

function getUserCompletedRequests(){
   $completed  = DB::table('requests')->select('*')
      ->where([
         'requestor'=>Auth::id(),
         'request_status'=>'completed'
      ])->get();
   return $completed;
}

function getUserPendingForApprovalCounter(){
   $pending_approval_counter = DB::table('requests')->select('*')
      ->whereIn(
         'request_status',['pending to supervisor','pending to manager'
      ])->count();
   return $pending_approval_counter;
}

function getUserPendingRequestCounter(){
   $pending_request_counter = DB::table('requests')->select('*')
      ->where([
         'requestor'       =>Auth::id(),
         'request_status'  =>'pending'
      ])->count();
   return $pending_request_counter;
}

function getUserRequestDetails($req_id){
   $get_req_details = DB::table('requests')->select('*')
      ->where([
         'request_id'=> $req_id
      ])->get();
   $array = array(
      'get_req_details'                =>$get_req_details,
      'completed'                      =>getUserCompletedRequests(),
      'pending'                        =>getUserPendingRequests(),
      'pending_counter'                =>getUserPendingRequestCounter(),
      'pending_for_approval_counter'   =>getUserPendingForApprovalCounter(),
   );
   return $array;
}

