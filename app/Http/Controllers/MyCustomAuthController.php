<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyCustomAuthController extends Controller
{
   public function authChecker(){
      
      if (Auth::check()) {

         if (auth()->user()->role == null) {
            
            return redirect()->route('user.home');

         } elseif (auth()->user()->role == 1) {

            return redirect()->route('admin.home');

         } elseif (auth()->user()->role == 2) {

            return redirect()->route('approver.home');

         } elseif (auth()->user()->role == 3) {

            return redirect()->route('manager.home');
         }
      } else {

         return view('auth.login');

      }
   }
}
