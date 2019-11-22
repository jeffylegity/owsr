<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
   public function managerReqDetails($req_id){
      $get_req_details = DB::table('requests')->select('*')->where(['request_id'=> $req_id])->get();
      return view('pages.manager.forms.manager_req_details')->with(['get_request_details'=>$get_req_details]);
   }
}
