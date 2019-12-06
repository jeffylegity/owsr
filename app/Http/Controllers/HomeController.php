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
      return view('pages.user.user_home')->with(userParameters());
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function approverHome()
    {
     
      return view('pages.approver.approver_home')
         ->with(approverParameters());
    }

    public function managerHome()
    {
      return view('pages.manager.manager_home',['taskOverview'=>managerTaskOverview()],['monthlyActivity'=>managerMonthlyActivity()])
         ->with(managerParameters());
    }

    public function adminHome()
    {
        return view('pages.admin.admin_home')
         ->with(adminParameters());
    }

    
    
}
