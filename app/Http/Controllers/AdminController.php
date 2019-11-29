<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function adminPendingRequests(){
      return view('pages.admin.admin_pending_request')
         ->with([adminParameters(),'pending_requests'=>getAdminPendingRequests()]);
   }
}
