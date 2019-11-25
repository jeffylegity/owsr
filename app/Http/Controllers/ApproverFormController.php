<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproverFormController extends Controller
{
   private $fileNameToStore;
   private $session_id;
   private $redirect_to;

   public function approverSubmitReqForm(Request $request){

   $this->session_id    = Auth::id();
   $request_to          = $request->input('request_to');
   $type_of_request     = implode(', ',$request->input('tor'));
   $area_of_request     = $request->input('area_of_request');
   $plant_designation   = $request->input('plant_designation');
   $model               = $request->input('model');
   $ln_bn               = $request->input('ln_bn');
   $request_concern     = $request->input('request_concern'); 
   $route_to_manager    = $request->input('route_to_manager');
   $request_status      = 'pending to manager';
   $date_requested      = now();
   $req_limiter         = DB::table('requests')->select('*')->where(['requestor'=>$this->session_id,])->whereIn('request_status',['pending','pending to manager'])->count();
   
   if ($request_to == 'EQUIPMENT ENGINEERING') {

      $this->redirect_to = redirect()->route('approver.ee_req_form');

   } elseif ($request_to == 'PLANT MAINTENANCE') {

      $this->redirect_to = redirect()->route('approver.pm_req_form');

   } elseif ($request_to == 'PROCESS ENGINEERING') {

      $this->redirect_to = redirect()->route('approver.pe_req_form');

   }

   if ($req_limiter >=3){

      toastr()->error('Request limit Exceeded');
      return $this->redirect_to;

   } else {

         if ($request->hasFile('attached_file')){

            $getFileName              = $request->file('attached_file')->getClientOriginalName();
            $fileName                 = pathinfo($getFileName, PATHINFO_FILENAME);
            $getExt                   = $request->file('attached_file')->getClientOriginalExtension();
            $this->fileNameToStore    = $fileName.'_'.time().'.'.$getExt;
            $path                     = $request->file('attached_file')->storeAs('public/attached_files', $this->fileNameToStore);

            if ( !in_array($getExt, array('jpeg','jpg','png','pdf','xls','xlsm','xlsx','docx'))){
               
               toastr()->error('Invalid file format');
               return $this->redirect_to;

            } else {

               $get_req_id                = DB::table('requests')->select('request_id')->orderBy('request_id','DESC')->limit(1)->get(); 
               $get_req_id_result         = $get_req_id->toArray();

               if (empty($get_req_id_result)){

                     $request_id = 1000;

               } else {

                     foreach($get_req_id_result as $req_id) {

                        $increment         =  $req_id->request_id;
                        $request_id  =  $increment+1;

                     }
               }   

               $data = array(
                     'request_to'           => $request_to,
                     'requestor'            => $this->session_id,
                     'request_id'           => $request_id,
                     'type_of_request'      => $type_of_request,
                     'area_of_request'      => $area_of_request,
                     'plant_designation'    => $plant_designation,   
                     'model'                => $model,
                     'ln_bn'                => $ln_bn,
                     'request_concern'      => $request_concern,
                     'route_to_supervisor'  => 'NOT APPLICABLE',
                     'route_to_manager'     => $route_to_manager,
                     'attached_file'        => $this->fileNameToStore,
                     'request_status'       => $request_status,
                     'date_requested'       => $date_requested,
               );

               $insert_data = DB::table('requests')->insert($data);

               if (!$insert_data){

                     echo"error";

               } else {
                  toastr()->success('Your request has been sent');
                  return $this->redirect_to;
                     
               }
            }

         } else {

            $get_req_id                = DB::table('requests')->select('request_id')->orderBy('request_id','DESC')->limit(1)->get(); 
            $get_req_id_result         = $get_req_id->toArray();

            if (empty($get_req_id_result)){

               $request_id = 1000;

            } else {

               foreach($get_req_id_result as $req_id) {

                  $increment         =  $req_id->request_id;
                  $request_id  =  $increment+1;

               }
            }   

            $data = array(
               'request_to'           => $request_to,
               'requestor'            => $this->session_id,
               'request_id'           => $request_id,
               'type_of_request'      => $type_of_request,
               'area_of_request'      => $area_of_request,
               'plant_designation'    => $plant_designation,   
               'model'                => $model,
               'ln_bn'                => $ln_bn,
               'request_concern'      => $request_concern,
               'route_to_supervisor'  => 'NOT APPLICABLE',
               'route_to_manager'     => $route_to_manager,
               'attached_file'        => $this->fileNameToStore,
               'request_status'       => $request_status,
               'date_requested'       => $date_requested,
               
            );

            $insert_data = DB::table('requests')->insert($data);
            
            if (!$insert_data) {

               echo"error";

            } else {

               toastr()->success('Your request has been sent');
               return $this->redirect_to;
               
            }
         }
      }
   }
}
