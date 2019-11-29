<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Charts\ManagerBarChart;
use App\Charts\ManagerPieChart;


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
   $jan = DB::table('requests')->select('*')->whereMonth('date_requested','=','01')->whereYear('date_requested','=',date('Y'))->count();
   $feb = DB::table('requests')->select('*')->whereMonth('date_requested','=','02')->whereYear('date_requested','=',date('Y'))->count();
   $mar = DB::table('requests')->select('*')->whereMonth('date_requested','=','03')->whereYear('date_requested','=',date('Y'))->count();
   $apr = DB::table('requests')->select('*')->whereMonth('date_requested','=','04')->whereYear('date_requested','=',date('Y'))->count();
   $may = DB::table('requests')->select('*')->whereMonth('date_requested','=','05')->whereYear('date_requested','=',date('Y'))->count();
   $jun = DB::table('requests')->select('*')->whereMonth('date_requested','=','06')->whereYear('date_requested','=',date('Y'))->count();
   $jul = DB::table('requests')->select('*')->whereMonth('date_requested','=','07')->whereYear('date_requested','=',date('Y'))->count();
   $aug = DB::table('requests')->select('*')->whereMonth('date_requested','=','08')->whereYear('date_requested','=',date('Y'))->count();
   $sep = DB::table('requests')->select('*')->whereMonth('date_requested','=','09')->whereYear('date_requested','=',date('Y'))->count();
   $oct = DB::table('requests')->select('*')->whereMonth('date_requested','=','10')->whereYear('date_requested','=',date('Y'))->count();
   $nov = DB::table('requests')->select('*')->whereMonth('date_requested','=','11')->whereYear('date_requested','=',date('Y'))->count();
   $dec = DB::table('requests')->select('*')->whereMonth('date_requested','=','12')->whereYear('date_requested','=',date('Y'))->count();
   $monthlyActivity->labels(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec',]);
   $monthy_data = $monthlyActivity->dataset('All requests per month', 'bar', array($jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec));
   $monthy_data->backgroundColor(collect(['#01939e','#034ea2','#01939e','#034ea2','#01939e','#034ea2','#01939e','#034ea2','#01939e','#034ea2','#01939e','#034ea2',]));
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


//Admin Helpers
function adminParameters(){
   $array = array(
      'pending_counter'    =>getAdminPendingCounter(),
      'ongoing_counter'    =>getAdminOngoingCounter(),
      'completed_counter'  =>getAdminCompletedCounter(),
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


