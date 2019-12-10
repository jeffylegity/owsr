<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Charts\ManagerBarChart;
use App\Charts\ManagerPieChart;
use App\Charts\AdminPieChart;
use App\Charts\AdminBarChart;
use Prophecy\Exception\Doubler\ReturnByReferenceException;

//Admin Helpers
function adminParameters(){
   $array = array(
      'pending_counter'     =>getAdminPendingCounter(),
      'completed_counter'   =>getAdminCompletedCounter(),
      'denied_counter'      =>getAdminDeniedCounter(),
      'pending_requests'    =>getAdminPendingRequests(),
      'completed_requests'  =>getAdminCompletedRequests(),
      'denied_requests'     =>getAdminDeniedRequests(),

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

function getAdminDeniedCounter(){
   $denied_counter = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'denied'
      ])->count();
   return $denied_counter;
}

function getAdminCompletedRequests(){
   $completed_requests = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'completed',
      ])
      ->get();
   return $completed_requests;
}

function getAdminDeniedRequests(){
   $denied_requests = DB::table('requests')->select('*')
      ->where([
         'request_to'         =>Auth::user()->department,
         'plant_designation'  =>Auth::user()->division,
         'request_status'     =>'denied',
      ])
      ->get();
   return $denied_requests;
}

function adminTaskOverview(){
   $all_pending   = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>Auth::user()->division,
         'request_to'         =>Auth::user()->department,
         'request_status'     =>'pending',
      ])->count();
   $all_completed   = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>Auth::user()->division,
         'request_to'         =>Auth::user()->department,
         'request_status'     =>'completed',
      ])->count();
   $all_denied   = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>Auth::user()->division,
         'request_to'         =>Auth::user()->department,
         'request_status'     =>'denied',
      ])->count();
   
   $taskOverview = new AdminPieChart;
   $taskOverview->displayAxes(false);
   $taskOverview->height(0);
   $taskOverview->width(0);
   $taskOverview->labels(['Pending','Completed','Denied']);
   $dataset = $taskOverview->dataset('Task Overview', 'doughnut', array($all_pending,$all_completed,$all_denied));
   $dataset->backgroundColor(collect(['#ff5b5b','#10c469','#f9c851']));
   return $taskOverview;
}

function adminMonthlyActivity(){
   $monthlyActivity = new AdminBarChart;
   $monthlyActivity->height(0);
   $monthlyActivity->width(0);

      $jan = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',1)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $feb = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',2)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $mar = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',3)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $apr = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',4)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $may = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',5)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $jun = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',6)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $jul = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',7)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $aug = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',8)
      ->whereYear('date_requested',date('Y'))
      ->count();
      
      $sep = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',9)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $oct = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',10)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $nov = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',11)
      ->whereYear('date_requested',date('Y'))
      ->count();

      $dec = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'plant_designation'=>Auth::user()->division])
      ->whereMonth('date_requested',12)
      ->whereYear('date_requested',date('Y'))
      ->count();

   $monthlyActivity->labels(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']);
   $monthy_data = $monthlyActivity->dataset('Task(s) recieved monthly', 'bar', array($jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec));
   $monthy_data->backgroundColor(collect(['#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e','#01939e']));
   return $monthlyActivity;

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

function getManagerPendingRequests(){
   $pending = DB::table('requests')->select('*')
      ->where([
         'request_to'      =>Auth::user()->department,
         'request_status'  =>'pending'
      ])->get();
   return $pending;
}

function getManagerCompletedRequests(){
   $completed = DB::table('requests')->select('*')
      ->where([
         'request_to'      =>Auth::user()->department,
         'request_status'  =>'completed',
      ])->get();
   return $completed;
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
      'completed_counter'     =>getManagerCompletedCounter(),
      'pending'               =>getManagerPendingRequests(),
      'completed'             =>getManagerCompletedRequests(),
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
         'request_status'     =>'pending',
         'request_to'         =>Auth::user()->department,
      ])->count();
   $plant7 = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>'PLANT 7',
         'request_status'     =>'pending',
         'request_to'         =>Auth::user()->department,
      ])->count();
   $plant8 = DB::table('requests')->select('*')
      ->where([
         'plant_designation'  =>'PLANT 8/9/10',
         'request_status'     =>'pending',
         'request_to'         =>Auth::user()->department,
      ])->count();

   // array($main,$plant7,$plant8)
   $monthlyActivity->labels(['Main Plant','Plant 7','Plant 8']);
   $monthy_data = $monthlyActivity->dataset('All Pending Requests per Plant', 'bar', array($main,$plant7,$plant8));
   $monthy_data->backgroundColor(collect(['#ff5b5b','#ff5b5b','#ff5b5b']));
   return $monthlyActivity;
}

function managerTaskOverview(){
   $all_pending   = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'pending'])
      ->count();
   $all_completed = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'completed'])
      ->count();
   $all_denied = DB::table('requests')->select('*')
      ->where(['request_to'=>Auth::user()->department,'request_status'=>'denied'])
      ->count();
   
   $taskOverview = new ManagerPieChart;
   $taskOverview->displayAxes(false);
   $taskOverview->height(0);
   $taskOverview->width(0);
   $taskOverview->labels(['Pending','Completed','Denied']);
   $dataset = $taskOverview->dataset('Task Overview', 'doughnut', array($all_pending,$all_completed,$all_denied));
   $dataset->backgroundColor(collect(['#ff5b5b','#10c469','#f9c851']));
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

