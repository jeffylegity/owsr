<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Charts\ManagerBarChart;
use App\Charts\ManagerPieChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userHome()
    {
      return view('pages.user.user_home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approverHome()
    {
      $for_approval = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_supervisor'=> Auth::user()->name,'request_status'=>'pending to supervisor'])->get();
      return view('pages.approver.approver_home')->with(['for_approval_requests' => $for_approval]);
    }

    public function managerHome()
    {
      $all_pending   = DB::table('requests')->select('*')->where(['request_to'=>Auth::user()->department,'request_status'=>'pending'])->count();
      $all_completed = DB::table('requests')->select('*')->where(['request_to'=>Auth::user()->department,'request_status'=>'completed'])->count();

      $taskOverview = new ManagerPieChart;
      $taskOverview->displayAxes(false);
      $taskOverview->height(0);
      $taskOverview->width(0);
      $taskOverview->labels(['Pending','Completed']);
      $dataset = $taskOverview->dataset('Task Overview', 'doughnut', array($all_pending,$all_completed));
      $dataset->backgroundColor(collect(['#ff5b5b','#10c469']));

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




      $for_approval = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_manager'=> Auth::user()->name,'request_status'=>'pending to manager'])->get();
      return view('pages.manager.manager_home',['taskOverview'=>$taskOverview],['monthlyActivity'=>$monthlyActivity])->with(['for_approval'=>$for_approval]);
    }

    public function adminHome()
    {
        return view('pages.admin.admin_home');
    }

    
    
}
