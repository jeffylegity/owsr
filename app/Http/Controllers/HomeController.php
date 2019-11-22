<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
      $for_approval = DB::table('requests')->select('*')->leftJoin('users','requests.requestor', '=', 'users.id')->where(['route_to_manager'=> Auth::user()->name,'request_status'=>'pending to manager'])->get();
      return view('pages.manager.manager_home')->with(['for_approval'=>$for_approval]);
    }

    public function adminHome()
    {
        return view('pages.admin.admin_home');
    }

    
    
}
