<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{ 

   public function userPendingReq()
   {
      return view('pages.user.user_pending')->with(userParameters());
   }

   public function userCompletedReq()
   {
      return view('pages.user.user_completed')->with(userParameters());
   }

   public function userEEreqForm()
   {
      $get_manager           = User::select('*')->where(['role'=>3,'department'=>'EQUIPMENT ENGINEERING'])->orderBy('name','ASC')->get();
      $get_all_supervisor    = User::select('*')->where(['role'=>2])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      $parameters = array(
         'get_manager'        => $get_manager, 
         'get_all_supervisor' => $get_all_supervisor,
         'get_all_department' => $get_all_department,
      );
      return view('pages.user.forms.user_ee_req_form')->with($parameters)->with(userParameters());
   }

   public function userPMreqForm()
   {
      $get_manager           = User::select('*')->where(['role'=>3,'department'=>'PLANT MAINTENANCE'])->orderBy('name','ASC')->get();
      $get_all_supervisor    = User::select('*')->where(['role'=>2])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      $parameters = array(
         'get_manager'        => $get_manager, 
         'get_all_supervisor' => $get_all_supervisor,
         'get_all_department' => $get_all_department,
      );
      return view('pages.user.forms.user_pm_req_form')->with($parameters)->with(userParameters());
   }

   public function userPEreqForm()
   {
      $get_manager           = User::select('*')->where(['role'=>3,'department'=>'PROCESS ENGINEERING'])->orderBy('name','ASC')->get();
      $get_all_supervisor    = User::select('*')->where(['role'=>2])->orderBy('name','ASC')->get();
      $get_all_department    = User::distinct()->select('department')->orderBy('department', 'ASC')->get();
      $parameters = array(
         'get_manager'        => $get_manager, 
         'get_all_supervisor' => $get_all_supervisor,
         'get_all_department' => $get_all_department,
      );
      return view('pages.user.forms.user_pm_req_form')->with($parameters)->with(userParameters());
   }

   public function userReqDetails($req_id)
   {
      return view('pages.user.forms.user_req_details')->with(getUserRequestDetails($req_id));
   }

}
